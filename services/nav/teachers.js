export default async function teachers(startOfURL, token) {
    const response = await fetch(`${startOfURL}/api/teachers`, {
        method: "GET",
        headers: {
            Authorization: `Bearer ${token}`
        },
    });

    if(response.ok) {
        const data = await response.json();

        return render(data);
    }

    async function render(teachers) {

        let teachersTable = '';

        teachers.forEach(({ id, name, email, city, address, phone, group }) => {
            teachersTable += `
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
                ${teachersTable}
            </table>`;
    }
}