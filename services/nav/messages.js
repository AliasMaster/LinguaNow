export default async function navmessages(startOfURL, token) {
  const response = await fetch(`${startOfURL}/api/messages`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  if (response.ok) {
    const data = await response.json();
    return render(data);
  }

  async function render(data) {
    let givenMessages = '';

    data.given.forEach(({ subject, from, role, message, date }) => {
      givenMessages += `
          <div class="messageBox">
              <div class="messageHeader" onclick="this.parentElement.classList.toggle('active')">
                  <h3>
                    Od: ${from} <span class="role">${role}</span>
                    <p class="date">${date}</p>
                  </h3>
                  <h4>Temat: <span class="subject">${subject}</span></h4>
                  <span class="material-symbols-outlined expandMore">
                    expand_more
                  </span>
              </div>
              <div class="divider"></div>
              <div class="messageContent">
                  ${message}
              </div>
          </div>`;
    });

    let sendedMessages = '';

    data.sended.forEach(({ subject, to, role, message, date }) => {
      sendedMessages += `
            <div class="messageBox">
                <div class="messageHeader" onclick="this.parentElement.classList.toggle('active')">
                    <h3>
                      Do: ${to} <span class="role">${role}</span>
                      <p class="date">${date}</p>
                    </h3>
                    <h4>Temat: <span class="subject">${subject}</span></h4>
                    <span class="material-symbols-outlined expandMore">
                      expand_more
                    </span>
                </div>
                <div class="divider"></div>
                <div class="messageContent">
                    ${message}
                </div>
            </div>`;
    });

    const addButton = `
      <button onclick="addMessage()" class="buttonMessage">Napisz wiadomość</button>
    `;

    return `
    <div class="sliderMessage"></div>
    ${addButton}
    <div class="messagesContainer">
            <div class="given messages">
                <header>
                  <h2>Otrzymane</h2>
                </header>
                <div class="userMessages">${givenMessages}</div>
            </div>
            <div class="sended messages">
                <header>
                    <h2>Wysłane</h2>
                </header>
                <div class="userMessages">${sendedMessages}</div>

            </div>
        </div>
        <div class="dialog">
          <div class="dialogContent"></div>
        </div>`;
  }
}
