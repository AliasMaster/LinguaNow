import startOfURL from './config/CONST.js';

import NavController from './services/NavController.js';

if (!localStorage.getItem('token')) {
  window.location.href = `${startOfURL}`;
}

const token = localStorage.getItem('token');

const userData = JSON.parse(localStorage.getItem('userData'));

const userBox = document.querySelector('.user');

const { fname, lname, role } = userData;

userBox.innerHTML = `
    <div class="userBox">
        <div>${fname} ${lname}</div>
        <span>${role}</span>
    </div>`;

new NavController(startOfURL, token);

const root = document.querySelector('#root');

const aside = document.querySelector('aside');
root.style.marginLeft = 28 + aside.offsetWidth + 'px';
