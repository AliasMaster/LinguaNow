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
                  <input type="checkbox" class="admission-checkBox checkBox" value="admissions-${id}">
                </td>
                <td>${name}</td>
                <td>${email}</td>
                <td>${phone}</td>
                <td>${course}</td>
                <td>${date}</td>
            </tr>`;
    });

    const selectAllCheckBoxes = `
      let checkValue = false;

      if (this.checked) {
        checkValue = true;
      }
      const checkBoxes = document.querySelectorAll('.admission-checkBox');
      checkBoxes.forEach((checkBox) => {
        checkBox.checked = checkValue;
      });`;

    return `<table>
                <tr>
                    <th>
                      <input type="checkbox" class="checkBox" onclick="${selectAllCheckBoxes}">
                    </th>
                    <th>Złaszający</th>
                    <th>E-mail</th>
                    <th>Telefon</th>
                    <th>Kurs</th>
                    <th>Data</th>
                </tr>
                ${admissionsTable}
            </table>`;
  }
}
