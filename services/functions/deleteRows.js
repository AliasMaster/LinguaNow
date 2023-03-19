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

async function deleteInDatabase(usersData, role) {
  const response = await fetch(`${startOfURL}/api/${role}s`, {
    method: 'DELETE',
    headers: {
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(usersData),
  });

  const data = response.json();

  message(response.ok, data.message);
}

export { deleteRows, cancel, deleteInDatabase };
