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

    items.forEach(({ name, functionName, icon }) => {
      navBox.innerHTML += `
                <div class="navItem" aria-functionName="${functionName}">
                    <div class="icon">
                        <span class="material-symbols-outlined">
                            ${icon}
                        </span>
                        <div class="text">${name}</div>
                    </div>
                </div>`;
    });
    return navBox;
  }
}
