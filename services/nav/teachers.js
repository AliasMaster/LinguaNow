import {
  selectAllCheckBoxes,
  onchangeCheckBox,
} from '../functions/checkBoxes.js';

const role = 'teacher';

export default async function teachers(startOfURL, token) {
  const response = await fetch(`${startOfURL}/api/teachers`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  if (response.ok) {
    const data = await response.json();

    return render(data);
  }

  async function render(teachers) {
    let teachersTable = '';

    teachers.forEach(({ id, name, email, city, address, phone, group }) => {
      teachersTable += `
            <tr class="teacher-${id}">
                <td>
                    <div class="checkBoxContainer teacher-checkBox" id="teacher-${id}" aria-name="${name}" onclick="this.classList.toggle('active'); onchangeCheckBox('${role}')">
                        <div class="checkBox">
                            <div class="checkBoxContent">
                                <span class="material-symbols-outlined icon">
                                    check
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="data-name">${name}</td>
                <td class="data-email">${email}</td>
                <td class="data-phone">${phone}</td>
                <td class="data-address">${address}</td>
                <td class="data-city">${city}</td>
                <td class="data-group">${group}</td>
                <td class="data-edit">
                  <div class="editContainer">
                    <span class="material-symbols-outlined" onclick="edit(this.parentElement.parentElement.parentElement, '${role}')">
                      edit
                    </span>
                  </div>
                </td>
            </tr>`;
    });

    return `
              <div class="sliderMessage"></div>
              <h2>Nauczyciele</h2>
              <button class="delete" onclick="deleteRows('${role}')">Usuń</button>
              <table>
                <tr>
                    <th>
                        <div class="checkBoxContainer teacherMain-checkBox" onclick="selectAllCheckBoxes(this, '${role}')">
                            <div class="checkBox">
                                <div class="checkBoxContent">
                                    <span class="material-symbols-outlined icon">
                                        check
                                    </span>
                                </div>
                            </div>
                        </div>
                    </th>
                    <th>Uczeń</th>
                    <th>E-mail</th>
                    <th>Telefon</th>
                    <th>Adres</th>
                    <th>Miasto</th>
                    <th>Grupa</th>
                    <th class="data-edit">Edycja</th>
                </tr>
                ${teachersTable}
            </table>
            <div class="dialog">
              <div class="dialogContent"></div>
            </div>`;
  }
}
