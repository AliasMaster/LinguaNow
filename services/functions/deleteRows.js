import { students, teachers, admissions } from '../nav/navFunctions.js';
import renderContent from '../render.js';

import startOfURL from '../../config/CONST.js';
const token = localStorage.getItem('token');

function deleteRows(role) {
  const checkBoxes = document.querySelectorAll(`.${role}-checkBox`);
  const activeCheckBoxes = Array.from(checkBoxes).filter((checkBox) => {
    return checkBox.classList.contains('active');
  });

  let roleText;

  switch (role) {
    case 'teacher':
      roleText = 'tych nauczycieli';
      break;
    case 'student':
      roleText = 'tych uczniów';
      break;
    case 'admission':
      roleText = 'te zgłoszenia';
      break;
    default:
      break;
  }

  const usersData = activeCheckBoxes.map((checkBox) => {
    return {
      id: checkBox.id,
      name: checkBox.getAttribute('aria-name'),
    };
  });

  const dialogBox = document.querySelector('.dialog');
  const dialogBoxContent = document.querySelector('.dialogContent');
  let dialogContent = '';

  dialogContent += `<h2>Czy na pewno chcesz usunąć ${roleText}?</h2>`;
  usersData.forEach((user) => {
    dialogContent += `<li>${user.name}</li>`;
  });

  dialogBox.classList.add('active');

  const buttons = `
    <div class='buttons'>
      <button onclick='cancel(this.parentElement.parentElement.parentElement)'>Anuluj</button>
      <button onclick='deleteInDatabase(${JSON.stringify(
        usersData,
      )}, "${role}"); cancel(this.parentElement.parentElement.parentElement);'>Usuń</button>
    </div>
  `;

  dialogBoxContent.innerHTML = dialogContent;
  dialogBoxContent.innerHTML += buttons;
}

function cancel(element) {
  element.classList.remove(`active`);
}

async function deleteInDatabase(users, role) {
  let endpoint = 'users';

  if (role === 'admission') {
    endpoint = 'admissions';
  }

  const messages = await Promise.all(
    users.map(async ({ id }) => {
      const cleanId = id.substring(id.indexOf('-') + 1);

      const response = await fetch(`${startOfURL}/api/${endpoint}/${cleanId}`, {
        method: 'DELETE',
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      const data = await response.json();

      return {
        ok: response.ok,
        responseMessage: data.message,
      };
    }),
  );

  let content = '';

  switch (role) {
    case 'student':
      content = await students(startOfURL, token);
      break;
    case 'teacher':
      content = await teachers(startOfURL, token);
      break;
    case 'admission':
      content = await admissions(startOfURL, token);
    default:
      break;
  }

  renderContent(content);

  const { ok, responseMessage } = messages.at(-1);
  message(ok, responseMessage);
}

export { deleteRows, cancel, deleteInDatabase };
