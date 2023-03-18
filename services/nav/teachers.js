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
                    <input type="checkbox" class="teacher-checkBox checkBox" value="teacher-${id}">
                </td>
                <td>${name}</td>
                <td>${email}</td>
                <td>${phone}</td>
                <td>${address}</td>
                <td>${city}</td>
                <td>${group}</td>
            </tr>`;
    });

    const selectAllCheckBoxes = `
      let checkValue = false;

      if (this.checked) {
        checkValue = true;
      }
      const checkBoxes = document.querySelectorAll('.teacher-checkBox');
      checkBoxes.forEach((checkBox) => {
        checkBox.checked = checkValue;
      });`;

    return `<table>
                <tr>
                    <th>
                        <input type="checkbox" class="checkBox" onclick="${selectAllCheckBoxes}">
                    </th>
                    <th>Uczeń</th>
                    <th>E-mail</th>
                    <th>Telefon</th>
                    <th>Adres</th>
                    <th>Miasto</th>
                    <th>Grupa</th>
                </tr>
                ${teachersTable}
            </table>`;
  }
}
