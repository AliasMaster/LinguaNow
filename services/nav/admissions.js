const role = 'admission';

export default async function admissions(startOfURL, token) {
  const response = await fetch(`${startOfURL}/api/admissions`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  if (response.ok) {
    const data = await response.json();

    return render(data);
  }

  async function render(admissions) {
    let admissionsTable = '';

    admissions.forEach(({ id, name, email, phone, course, date }) => {
      admissionsTable += `
            <tr class="admission-${id}">
                <td>
                    <div class="checkBoxContainer admission-checkBox" id="admission-${id}" aria-name="${name}" onclick="this.classList.toggle('active'); onchangeCheckBox('${role}')">
                        <div class="checkBox">
                            <div class="checkBoxContent">
                                <span class="material-symbols-outlined icon">
                                    check
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td>${name}</td>
                <td>${email}</td>
                <td>${phone}</td>
                <td>${course}</td>
                <td>${date}</td>
            </tr>`;
    });

    return `
            <div class="message"></div>
            <h2>Zgłoszenia</h2>
            <button class="delete" onclick="deleteRows('${role}')">Usuń</button>
            <table>
              <tr>
                  <th>
                      <div class="checkBoxContainer admissionMain-checkBox" onclick="selectAllCheckBoxes(this, '${role}')">
                          <div class="checkBox">
                              <div class="checkBoxContent">
                                  <span class="material-symbols-outlined icon">
                                      check
                                  </span>
                              </div>
                          </div>
                      </div>
                  </th>
                  <th>Złaszający</th>
                  <th>E-mail</th>
                  <th>Telefon</th>
                  <th>Kurs</th>
                  <th>Data</th>
              </tr>
              ${admissionsTable}
          </table>
          <div class="dialog">
            <div class="dialogContent"></div>
          </div>`;
  }
}
