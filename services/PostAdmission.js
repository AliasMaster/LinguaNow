export default class PostAdmission {
  constructor(startOfURL) {
    this.post(startOfURL);
  }

  async post(startOfURL) {
    const form = {
      fname: document.querySelector('#signInForm .fname').value,
      lname: document.querySelector('#signInForm .lname').value,
      email: document.querySelector('#signInForm .email').value,
      level: document.querySelector('#signInForm .level').value,
      tel: document.querySelector('#signInForm .tel').value,
    };

    const response = await fetch(`${startOfURL}/api/signIn`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(form),
    });

    const data = await response.json();

    if (response.ok) {
      //
    } else {
      const errorFormBox = document.querySelector('.errorMessageForm') || null;
      if (errorFormBox) {
        errorFormBox.innerHTML = `<span class="errorMessage">${data.message}</span>`;
      }
    }
  }
}
