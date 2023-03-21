import startOfURL from '../../config/CONST.js';
const token = localStorage.getItem('token');

function edit(row, role) {
  const userData = {
    id: row.classList.value.substring(row.classList.value.indexOf('-') + 1),
    name: row.querySelector('.data-name').textContent,
    email: row.querySelector('.data-email').textContent,
    phone: row.querySelector('.data-phone').textContent,
    address: row.querySelector('.data-address').textContent,
    group: row.querySelector('.data-group').textContent,
  };

  const dialogBox = document.querySelector('.dialog');
  const dialogBoxContent = document.querySelector('.dialogContent');
  let dialogContent = '';

  dialogContent += `<h2>Edycja</h2>`;
  dialogContent += `
    <div>
      <p>${role}: ${userData.name}</p>
      <div class="input-container">
        <input
          type="number"
          id="editGroupId"
          value=""
          aria-labelledby="label-group"
        />
        <label class="label" for="editGroupId" id="label-fname">
          <div class="text">Grupa</div>
        </label>
      </div>
    </div>
  `;

  dialogBox.classList.add('active');

  const buttons = `
    <div class='buttons'>
      <button onclick='cancel(this.parentElement.parentElement.parentElement)'>Anuluj</button>
      <button onclick='updateInDatabase("${role}", ${userData.id}); cancel(this.parentElement.parentElement.parentElement);'>Edytuj</button>
    </div>
  `;

  dialogBoxContent.innerHTML = dialogContent;
  dialogBoxContent.innerHTML += buttons;
  inputs();
}

async function updateInDatabase(role, id) {
  const groupId = document.querySelector('#editGroupId').value;
  if (!groupId == '') {
    const response = await fetch(`${startOfURL}/api/users/${id}`, {
      method: 'PUT',
      headers: {
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ groupId: groupId }),
    });

    const data = await response.json();

    if (response.ok) {
      const row = document.querySelector(`.${role}-${id}`);
      row.querySelector('.data-group').innerHTML = groupId;
      message(response.ok, data.message);
    }
  } else {
    message(false, 'Nie wybrano grupy');
  }
}

export { edit, updateInDatabase };
