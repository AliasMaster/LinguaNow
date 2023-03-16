export default function logOut() {
    localStorage.removeItem('token');
    localStorage.removeItem('userData');

    window.location.reload();
}