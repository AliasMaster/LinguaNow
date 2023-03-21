function inputs() {
  const input = document.querySelector('.dialog .input-container input');
  const textarea = document.querySelector('.dialog .input-container textarea');
  const select = document.querySelector('.dialog .input-container select');

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

  if (select) {
    select.addEventListener('input', () => {
      select.setAttribute('value', select.value);
    });
  }
}

window.inputs = inputs;
