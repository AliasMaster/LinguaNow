const userData = JSON.parse(localStorage.getItem('userData'));

export default async function marks(startOfURL, token) {
  switch (userData.role) {
    case 'nauczyciel':
      return renderTeacher(startOfURL, token);
      break;
    case 'uczeń':
      return renderUser(startOfURL, token);
      break;
    default:
      break;
  }
}

async function renderUser(startOfURL, token) {
  const marks = (await fetchMarks(startOfURL, token)).marks;

  let rowMarks = '';
  let sumOfMarks = 0;

  marks.forEach(({ mark, description, date }) => {
    sumOfMarks += mark;
    rowMarks += `
        <tr>
            <td>${mark}</td>
            <td>${description}</td>
            <td>${date}</td>
        </tr>
    `;
  });

  const average = Math.round((sumOfMarks * 100) / marks.length) / 100 || 0;

  return `
        <h2>Oceny</h2>
        <p>Średnia: ${average}</p>
        <table>
            <tr>
                <th>Ocena</th>
                <th>Opis</th>
                <th>Data</th>
            </tr>
            ${rowMarks}
        </table>
    `;
}

async function renderTeacher(startOfURL, token) {
  const users = (await fetchMarks(startOfURL, token)).users;

  if (users) {
    let usersRows = '';

    users.forEach(({ id, name, marks }) => {
      let marksRow = '';

      let sumOfMarks = 0;

      marks.forEach(({ mark, description, date }) => {
        sumOfMarks += mark;
        marksRow += `
          <div class="mark">${mark},
            <span class="tooltip">
                <p>Opis: ${description}</p>
                <p>Data: ${date}</p>
            </span>
          </div>
          `;
      });

      const average = Math.round((sumOfMarks * 100) / marks.length) / 100 || 0;

      usersRows += `
            <tr class="user-${id}">
                <td>${name}</td>
                <td>${marksRow}</td>
                <td class="data-average">${average}</td>
                <td class="iconRow">
                    <div class="addContainer" onclick="addMark(this.parentElement.parentElement)">
                        <span class="material-symbols-outlined icon">
                            add
                        </span>
                    </div>
                </td>
            </tr>
        `;
    });

    return `
        <div class="sliderMessage"></div>
        <h2>Oceny</h2>
        <table>
            <tr>
                <th>Uczeń</th>
                <th>Oceny</th>
                <th>Średnia</th>
                <th class="iconRow">Dodaj ocene</th>
            </tr>
            ${usersRows}
        </table>
        <div class="dialog">
            <div class="dialogContent"></div>
        </div>
    `;
  } else {
    return false;
  }
}

async function fetchMarks(startOfURL, token) {
  const response = await fetch(`${startOfURL}/api/marks/${userData.id}`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  const data = await response.json();

  return data;
}
