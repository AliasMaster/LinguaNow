export default function home() {
  const userData = JSON.parse(localStorage.getItem('userData'));

  return `<h1>Witaj ${userData.fname}!</h1>`;
}
