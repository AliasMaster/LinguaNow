export default async function students(startOfURL, token) {
    const response = await fetch(`${startOfURL}/api/students`, {
        method: "GET",
        headers: {
            Authorization: `Bearer ${token}`
        },
    });

    if(response.ok) {
        const data = await response.json();

        return render(data);
    }

    async function render(students) {

        let studentsTable = '';

        students.forEach(({ id, name, email, city, address, phone, group }) => {
            studentsTable += `
            <tr class="student-${id}">
                <td>${name}</td>
                <td>${email}</td>
                <td>${phone}</td>
                <td>${address}</td>
                <td>${city}</td>
                <td>${group}</td>
            </tr>`
        });

        return `<table>
                <tr>
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