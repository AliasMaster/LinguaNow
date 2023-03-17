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
            <div class="group" onclick="this.classList.toggle('active')">
                <div class="card">
                  <div>
                    <h3>Grupa: ${group}</h3>
                    <p>
                      <span class="material-symbols-outlined teacherIcon">
                        person
                      </span>
                      ${teacher}
                    </p>
                  </div>
                  <span class="material-symbols-outlined expandMore">
                    expand_more
                  </span>
                </div>
                <div class="expand">
                  <div class="divider"></div>
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
