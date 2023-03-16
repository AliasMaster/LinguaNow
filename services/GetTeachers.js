export default class getTeachers {
  constructor(startOfURL) {
    return this.getAll(startOfURL);
  }

  async getAll(startOfURL) {
    const response = await fetch(`${startOfURL}/api/teachers`);

    if (response.ok) {
      const data = await response.json();

      this.teachers = data.teachers;
      this.insertValues();
    }
  }

  insertValues() {
    const subpageTeachersBox =
      document.querySelector('.subpage .teachers') || null;

    if (subpageTeachersBox) {
      this.teachers.forEach(({ name, description, img }) => {
        subpageTeachersBox.innerHTML += `
            <article class="teacher">
                <img src="../../assets/images/teachers/${img}" alt="${name}">
                <div class=\"teacher-text\">
                    <h3>${name}</h3>
                    <p>${description}</p>
                </div>
            </article>
            `;
      });
    }
  }
}
