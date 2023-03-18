export default async function students(startOfURL, token) {
  const response = await fetch(`${startOfURL}/api/students`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  if (response.ok) {
    const data = await response.json();

    return render(data);
  }

  async function render(students) {
    let studentsTable = '';

    // <input type="checkbox" class="student-checkBox checkBox" value="student-${id}" checked>
    //<label></label>

    students.forEach(({ id, name, email, city, address, phone, group }) => {
      studentsTable += `
            <tr class="student-${id}">
                <td>
                    <div class="checkBoxContainer student-checkBox" onclick="this.classList.toggle('active');">
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
                <td>${address}</td>
                <td>${city}</td>
                <td>${group}</td>
            </tr>`;
    });

    function selectAllCheckBoxes(headerCheckBox) {
      headerCheckBox.classList.toggle('active');

      const checkBoxes = document.querySelectorAll('.student-checkBox');

      if (headerCheckBox.classList.contains('active')) {
        checkBoxes.forEach((checkBox) => {
          console.log(checkBox);
          checkBox.classList.add('active');
        });
      } else {
        checkBoxes.forEach((checkBox) => {
          checkBox.classList.remove('active');
        });
      }
    }

    return `<table>
                <tr>
                    <th>
                        <div class="checkBoxContainer student-checkBox" onclick="(${selectAllCheckBoxes.toString()})(this)">
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
                </tr>
                ${studentsTable}
            </table>`;
  }
}
