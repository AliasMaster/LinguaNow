import startOfURL from '../../config/CONST.js';

async function addMessage() {
  const users = await fetchUsers();
  const select = filterUsers(users);

  insertToDialogBox(select);
}

async function fetchUsers() {
  const token = localStorage.getItem('token');

  const response = await fetch(`${startOfURL}/api/users`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  const users = (await response.json()).users;

  const teachers = users.filter((user) => user.role === 'nauczyciel');
  const students = users.filter((user) => user.role === 'uczeń');
  const headTeacher = users.filter((user) => user.role === 'dyrektor');

  return {
    students: students,
    teachers: teachers,
    headTeacher: headTeacher,
  };
}

async function filterUsers(users) {
  const studentsOption = users.students.map(({ id, name }) => {
    return `<option value="user-${id}">${name}</option>`;
  });

  const teachersOption = users.teachers.map(({ id, name }) => {
    return `<option value="user-${id}">${name}</option>`;
  });

  let optionGroup = '';

  if (users.headTeacher.length > 0) {
    const headTeacherOption = users.headTeacher.map(({ id, name }) => {
      return `<option value="user-${id}">${name}</option>`;
    });
    optionGroup = `
    <optgroup label="Dyrektorzy" class="stationery">
    ${headTeacherOption}
    </optgroup>`;
  }

  return `
    <select name="userSelect" id="userSelect">
        <option value="deafault" disabled selected>Wybierz użytkownika</option>
            ${optionGroup}
        <optgroup label="Nauczyciele" class="teachers">
            ${teachersOption}
        </optgroup>
        <optgroup label="Uczniowie" class="students">
            ${studentsOption}
        </optgroup>
    </select>
  `;
}

async function insertToDialogBox(select) {
  const dialogBox = document.querySelector('.dialog');
  dialogBox.classList.toggle('active');
  const dialogBoxContent = dialogBox.querySelector('.dialogContent');

  const buttons = `
  <div class='buttons'>
    <button onclick='cancel(this.parentElement.parentElement.parentElement)'>Anuluj</button>
    <button onclick='sendMessage(); cancel(this.parentElement.parentElement.parentElement);'>Wyślij</button>
  </div>
`;

  const selectData = await select;

  let content = `
      <div class="dialogForm">
        ${selectData}
        <div class="input-container">
          <input
            type="text"
            id="dialogSubject"
            value=""
            aria-labelledby="label-subject"
          />
          <label class="label" for="dialogSubject" id="label-subject">
            <div class="text">Temat</div>
          </label>
        </div>
        <div class="input-container">
          <textarea
            size="1"
            type="text"
            id="dialogMessage"
            value=""
            aria-labelledby="label-subject"
          ></textarea>
          <label class="label" for="dialogMessage" id="label-message">
            <div class="text">Wiadomość</div>
          </label>
        </div>
      </div>
        ${buttons}
    `;

  dialogBoxContent.innerHTML = content;
  inputs();
}

async function sendMessage() {
  const dialogBox = document.querySelector('.dialog');
  const userSelect = dialogBox.querySelector('#userSelect').value;

  const dialogSelect = userSelect.substring(userSelect.indexOf('-') + 1);
  const dialogSubject = dialogBox.querySelector('#dialogSubject').value;
  const dialogMessage = dialogBox.querySelector('#dialogMessage').value;

  const messageData = {
    recipient: dialogSelect,
    subject: dialogSubject,
    message: dialogMessage,
  };

  const token = localStorage.getItem('token');
  const response = await fetch(`${startOfURL}/api/messages`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(messageData),
  });

  const responseMessage = await response.json();

  message(response.ok, responseMessage.message);

  if (response.ok) {
    const sendedBox = document.querySelector('.messages.sended .userMessages');

    const { to, subject, date, message, role } = responseMessage.data;

    const prepareMessage = `
            <div class="messageBox">
              <div class="messageHeader" onclick="this.parentElement.classList.toggle('active')">
                  <h3>
                    Od: ${to} <span class="role">${role}</span>
                    <p class="date">${date}</p>
                  </h3>
                  <h4>Temat: <span class="subject">${subject}</span></h4>
                  <span class="material-symbols-outlined expandMore">
                    expand_more
                  </span>
              </div>
              <div class="divider"></div>
              <div class="messageContent">
                  ${message}
              </div>
          </div>`;

    sendedBox.innerHTML = prepareMessage + sendedBox.innerHTML;
  }
}

export { addMessage, sendMessage };
