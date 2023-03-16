export default async function groups(startOfURL, token) {
  const response = await fetch(`${startOfURL}/api/groups`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  if (response.ok) {
    const groups = await response.json();
    return render(groups);
  }

  async function render(groups) {
    let groupsList = '';

    groups.forEach(({ group, teacher, students }) => {
      let studentsList = '';
      students.forEach((student) => {
        studentsList += `<li>${student}</li>`;
      });
      groupsList += `
            <div class="group">
                <div class="card">
                  <h3>Grupa: ${group}</h3>
                  <p>
                    <span class="material-symbols-outlined teacherIcon">
                      person
                    </span>
                    ${teacher}
                  </p>
                  <span class="material-symbols-outlined expandMore">
                    expand_more
                  </span>
                </div>
                <div class="expand">
                  <h5>Uczniowie</h5>
                  <ul class="students">${studentsList}</ul>
                </div>
            </div>`;
    });

    return `
        <div class="groups">
            <h2>Grupy</h2>
            ${groupsList}
        </div>`;
  }
}
