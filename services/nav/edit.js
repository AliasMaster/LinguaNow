export default function edit(row) {
  const userData = {
    id: row.classList.value.substring(row.classList.value.indexOf('-') + 1),
    name: row.querySelector('.data-name').textContent,
    email: row.querySelector('.data-email').textContent,
    phone: row.querySelector('.data-phone').textContent,
    address: row.querySelector('.data-address').textContent,
    group: row.querySelector('.data-group').textContent,
  };

  console.log(userData);
}
