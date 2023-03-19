function message(ok, message) {
  const messageBox = document.querySelector('.message');
  let className;
  if (ok) {
    className = 'succed';
  } else {
    className = 'error';
  }

  messageBox.classList.add(className);
  const messageContent = `
    <div>${message}</div>
    <span class="material-symbols-outlined icon" onclick="closeElement(this.parentElement)">
        close
    </span>`;

  messageBox.innerHTML = messageContent;
}

function closeElement(element) {
  element.classList.remove('error');
  element.classList.remove('succed');
}

window.message = message;
window.close = close;
