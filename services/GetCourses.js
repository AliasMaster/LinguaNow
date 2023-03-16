export default class GetCourses {
  constructor(startOfURL) {
    return this.getAll(startOfURL);
  }

  async getAll(startOfURL) {
    const response = await fetch(`${startOfURL}/api/courses`);

    if (response.ok) {
      const data = await response.json();

      this.courses = data.courses;
      this.insertValues();
    }
  }

  insertValues() {
    // get courses
    const stationeryCourses = this.courses.filter(
      (course) => course.type === 'Stacjonarny',
    );

    const onlineCourses = this.courses.filter(
      (course) => course.type === 'Online',
    );

    // HOME PAGE INSERT

    //insert into courses section
    const stationaryBox =
      document.querySelector('.courses.stationery .course-offer') || null;

    if (stationaryBox) {
      stationeryCourses.forEach(({ name }) => {
        stationaryBox.innerHTML += `<li><span>${name}</span></li>`;
      });
    }

    //insert into online section
    const onlineBox =
      document.querySelector('.courses.online .course-offer') || null;

    if (onlineBox) {
      onlineCourses.forEach(({ name }) => {
        onlineBox.innerHTML += `<li><span>${name}</span></li>`;
      });
    }

    // COURSE PAGE INSERT

    const subpageCoursesStationeryBox =
      document.querySelector('.subpage .courses.stationery') || null;

    if (subpageCoursesStationeryBox) {
      stationeryCourses.forEach(({ name, description }) => {
        subpageCoursesStationeryBox.innerHTML += `
        <section class="course-text">
            <h4>${name}</h4>
            <p>${description}</p>
        </section>`;
      });
    }

    const subpageCoursesOnlineBox =
      document.querySelector('.subpage .courses.online') || null;

    if (subpageCoursesOnlineBox) {
      onlineCourses.forEach(({ name, description }) => {
        subpageCoursesOnlineBox.innerHTML += `
          <section class="course-text">
              <h4>${name}</h4>
              <p>${description}</p>
          </section>`;
      });
    }

    // FOOTER SELECT INSERT

    const footerSelectStationeryBox =
      document.querySelector('.footer-courses-select .stationery') || null;

    if (footerSelectStationeryBox) {
      stationeryCourses.forEach(({ id, name }) => {
        footerSelectStationeryBox.innerHTML += `<option value=\"course-${id}\">${name}</option>`;
      });
    }

    const footerSelectOnlineBox =
      document.querySelector('.footer-courses-select .online') || null;
    if (footerSelectOnlineBox) {
      onlineCourses.forEach(({ id, name }) => {
        footerSelectOnlineBox.innerHTML += `<option value=\"course-${id}\">${name}</option>`;
      });
    }
  }
}
