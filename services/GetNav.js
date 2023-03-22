export default class GetNav {
  constructor(startOfURL, token) {
    return this.get(startOfURL, token);
  }

  async get(startOfURL, token) {
    const respone = await fetch(`${startOfURL}/api/nav`, {
      method: 'GET',
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    if (respone.ok) {
      const data = await respone.json();

      return this.parseItemsToNav(data.items);
    } else {
      const data = await respone.json();
    }
  }

  parseItemsToNav(items) {
    const navBox = document.querySelector('.navListItems');

    let content = '';
    items.forEach(({ name, functionName, icon }) => {
      content += `
                <div class="navItem ${
                  name == 'home' ? 'active' : ''
                }" aria-functionName="${functionName}">
                    <span class="material-symbols-outlined">
                        ${icon}
                    </span>
                    <div class="text">${name}</div>
                </div>`;
    });

    navBox.innerHTML = content;
    eventListenerForNavItems();
    return navBox;
  }
}
