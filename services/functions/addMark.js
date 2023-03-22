import startOfURL from '../../config/CONST.js';
import renderContent from '../render.js';
import marks from '../nav/marks.js';

function addMark(user) {
  const userClass = Array.from(user.classList).filter((className) =>
    className.includes('user-'),
  );

  if (userClass.length == 1) {
    const id = userClass[0].substring(userClass[0].indexOf('-') + 1);
    dialog(id);
  }
}

function dialog(id) {
  const dialogBox = document.querySelector('.dialog');
  const dialogBoxContent = document.querySelector('.dialogContent');
  let dialogContent = '';

  dialogContent += `<h2>Dodawanie oceny</h2>`;
  dialogContent += `
      <div class="dialogForm">
        <div class="input-container">
          <input
            type="number"
            id="addMark"
            value=""
            aria-labelledby="label-group"
          />
          <label class="label" for="addMark" id="label-mark">
            <div class="text">Ocena</div>
          </label>
        </div>
        <div class="input-container">
          <input
            type="text"
            id="markDescription"
            value=""
            aria-labelledby="label-group"
          />
          <label class="label" for="markDescription" id="label-description">
            <div class="text">Opis</div>
          </label>
        </div>
      </div>
    `;

  dialogBox.classList.add('active');

  const buttons = `
      <div class='buttons'>
        <button onclick='cancel(this.parentElement.parentElement.parentElement)'>Anuluj</button>
        <button onclick='put(${id}); cancel(this.parentElement.parentElement.parentElement);'>Edytuj</button>
      </div>
    `;

  dialogBoxContent.innerHTML = dialogContent;
  dialogBoxContent.innerHTML += buttons;
  inputs();
}

async function put(id) {
  const mark = document.querySelector('#addMark').value || null;
  const description = document.querySelector('#markDescription').value || null;

  if (mark && description) {
    const token = localStorage.getItem('token');
    const response = await fetch(`${startOfURL}/api/marks/${id}`, {
      method: 'PUT',
      headers: {
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({
        mark: mark,
        description: description,
      }),
    });

    const data = await response.json();

    let content = await marks(startOfURL, token);

    renderContent(content);

    message(response.ok, data.message);
  }
}

export { addMark, put };
