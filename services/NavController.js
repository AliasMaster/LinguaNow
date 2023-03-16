import GetNav from "./GetNav.js";
import renderContent from "./render.js";
import navFunctions from "./nav/navFunctions.js";

const { logOut, navmessages, students, teachers } = navFunctions

export default class NavController {
    constructor(startOfURL, token) {
        this.startOfURL = startOfURL,

        this.controller(token);
    }

    async controller(token) {

        const navBox = await new GetNav(this.startOfURL, token);
        
        const navItems = navBox.querySelectorAll('.navItem');

        navItems.forEach(navItem => {
            navItem.addEventListener('click', async () => {
                const functionName = navItem.getAttribute('aria-functionName');
                let content = '';

                switch (functionName) {
                    case 'messages':
                        content = await navmessages(this.startOfURL, token);
                        break;
                    case 'logOut':
                        logOut();
                        break;
                    case 'students':
                        content = await students(this.startOfURL, token);
                        break;
                        case 'teachers':
                        content = await teachers(this.startOfURL, token);
                        break;
                    default:
                        break;
                }

                renderContent(content);

            })
        })
    }
}