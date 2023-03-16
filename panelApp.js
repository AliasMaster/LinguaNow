import startOfURL from './config/CONST.js';

// import GetNav from './services/GetNav.js';
import NavController from './services/NavController.js';

if(!localStorage.getItem('token')) {
    window.location.href = `${startOfURL}/`;
}

const token = localStorage.getItem('token');

const userData = JSON.parse(localStorage.getItem('userData'));

// new GetNav(startOfURL, token);

new NavController(startOfURL, token);