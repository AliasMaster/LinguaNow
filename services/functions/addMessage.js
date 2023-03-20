import startOfURL from "../../config/CONST.js";

async function addMessage() {
    const users = await fetchUsers();
    const select = filterUsers(users);

    insertToDialogBox(select)
}

function insertToDialogBox(select) {
    const dialogBox = document.querySelector('.dialog');
    dialogBox.classList.toggle('active');
    const dialogBoxContent = dialogBox.querySelector('.dialogContent');

    let content = `
        
    `;

    dialogBoxContent.innerHTML = content
}

async function fetchUsers() {
    const token = localStorage.getItem('token');

    const response = await fetch(`${startOfURL}/api/users`, {
        method: "GET",
        headers: {
            Authorization: `Bearer ${token}`,
        }
    });

    const users = (await response.json()).users;

    const teachers = users.filter(user => user.role === 'nauczyciel');
    const students = users.filter(user => user.role === 'uczeń');
    const headTeacher = users.filter(user => user.role === 'dyrektor');
    
    return {
        "students": students,
        "teachers": teachers,
        "headTeacher": headTeacher
    }
}

async function filterUsers(users) {

    const studentsOption = users.students.map(({id, name}) => {
        return `<option class="user-${id}">${name}</option>`;
    });

    const teachersOption = users.teachers.map(({id, name}) => {
        return `<option class="user-${id}">${name}</option>`;
    });

    let optionGroup = '';

    if(users.headTeacher.length > 0) {
        const headTeacherOption = users.headTeacher.map(({id, name}) => {
            return `<option class="user-${id}">${name}</option>`;
        });
        optionGroup = `
        <optgroup label="Dyrektorzy" class="stationery">
            ${headTeacherOption}
        </optgroup>`;
    }

    return select = `
        <select>
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

export { addMessage, fetchUsers, insertToDialogBox, filterUsers }