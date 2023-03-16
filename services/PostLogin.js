export default class PostLogin {
  constructor(startOfURL) {
    this.login(startOfURL);
  }

  async login(startOfURL) {
    const postData = {
      email: document.querySelector('.subpage .login .email').value,
      password: document.querySelector('.subpage .login .password').value,
    };

    const response = await fetch(`${startOfURL}/api/login`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(postData),
    });

    const data = await response.json();

    if (response.ok) {
      localStorage.setItem('token', data.token);
      localStorage.setItem('userData', JSON.stringify(data.userData));

      window.location.href = `${startOfURL}/Panel`;
    } else {
      const errorMessageBox = document.querySelector('.errorMessageLogin');

      errorMessageBox.innerHTML = `<span class="errorMessage">${data.message}</span>`;
    }
  }
}
