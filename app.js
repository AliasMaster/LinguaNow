import GetCourses from './services/GetCourses.js';
import GetTeachers from './services/GetTeachers.js';
import PostAdmission from './services/PostAdmission.js';
import PostLogin from './services/PostLogin.js';

import startOfURL from './config/CONST.js';

if (localStorage.getItem('token')) {
  window.location.href = `${startOfURL}/Panel`;
}

new GetCourses(startOfURL);

if (!(typeof isTeachers === 'undefined') && isTeachers) {
  new GetTeachers(startOfURL);
}

const submitFooterForm = document.querySelector('.submitFooterForm') || null;

if (submitFooterForm) {
  submitFooterForm.addEventListener('click', () => {
    new PostAdmission(startOfURL);
  });
}

const submitLogin = document.querySelector('.submitLogin') || null;

if (submitLogin) {
  submitLogin.addEventListener('click', () => {
    new PostLogin(startOfURL);
  });
}
