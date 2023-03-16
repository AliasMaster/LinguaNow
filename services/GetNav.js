export default class GetNav {
    constructor(startOfURL, token) {
        return this.get(startOfURL, token);
    }

    async get(startOfURL, token) {
        const respone = await fetch(`${startOfURL}/api/nav`, {
            method: "GET",
            headers: {
                Authorization: `Bearer ${token}`
            },
        });
        
        if(respone.ok) {
            const data = await respone.json();

            return this.parseItemsToNav(data.items);
        } else {
            const data = await respone.json();
            
        }
    }
    
    parseItemsToNav(items) {

        const navBox = document.querySelector('.navListItems');

        items.forEach(({ name, functionName }) => {
            navBox.innerHTML += `<li class="navItem" aria-functionName="${functionName}">${name}</li>`;
        });
        return navBox;
    }
}