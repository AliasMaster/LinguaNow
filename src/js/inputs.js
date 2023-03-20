function inputs() {
  const input = document.querySelector('.dialog .input-container input');
  const textarea = document.querySelector('.dialog .input-container textarea');

  if (input) {
    input.addEventListener('input', () => {
      input.setAttribute('value', input.value);
    });
  }

  if (textarea) {
    textarea.addEventListener('input', () => {
      textarea.setAttribute('value', textarea.value);
    });
  }
}

window.inputs = inputs;
