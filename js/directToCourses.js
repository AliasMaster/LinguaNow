const button = document.querySelector('.directToCourses');
const coursesSection = document.querySelector('#kursy');

button.addEventListener('click', () => {
  coursesSection.scrollIntoView({
    behavior: 'smooth',
    block: 'center',
    inline: 'start',
  });
});
