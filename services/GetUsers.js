class GetUsers {
  constructor(startOfUrl, token) {
    this.startOfUrl = startOfUrl;
    this.get(token);
  }

  async get(token) {
    const response = await fetch(`${this.startOfUrl}/api/users'`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    const data = await response.json();

    const users = data.users;
    console.log(users);

    // let userBox = document.querySelector('.users');

    // users.forEach(user => {
    //     userBox.innerHTML+= user.email + "<br>"
    //     userBox.innerHTML+= user.password + "<br><br>"
    //     userBox.innerHTML+= user.hashPassword + "<br><br>"
    // });
  }
}
