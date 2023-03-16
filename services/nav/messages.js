export default async function navmessages(startOfURL, token) {
    const response = await fetch(`${startOfURL}/api/messages`, {
        method: "GET",
        headers: {
            Authorization: `Bearer ${token}`
        },
    });

    if(response.ok) {
        const data = await response.json();
        return render(data);
    }

    async function render(data) {

        let givenMessages = '';

        data.given.forEach(({ subject, from, role, message }) => {
            givenMessages += `<div class="message">
                <div class="messageHeader">
                    <h3>Od: ${from} <span class="role">${role}</span></h3>
                    <h4>Temat: ${subject}</h4>
                </div>
                <div class="messegeContent">
                    ${message}
                </div>
            </div>`;
        });

        let sendedMessages = '';

        data.sended.forEach(({ subject, to, role, message }) => {
            sendedMessages += `<div class="message">
                <div class="messageHeader">
                    <h3>Od: ${to} <span class="role">${role}</span></h3>
                    <h4>Temat: ${subject}</h4>
                </div>
                <div class="messegeContent">
                    ${message}
                </div>
            </div>`;
        });

        return `<div class="messages">
            <div class="given">
                <header>
                    <h2>Otrzymane</h2>
                <div class="messages">${givenMessages}</div>
            </div>
            <div class="sended">
                <header>
                    <h2>Wysłane</h2>
                </header>
                <div class="messages">${sendedMessages}</div>

            </div>
        </div>`;
    }
}