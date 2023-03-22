function inputs() {
  const inputs = document.querySelectorAll('.dialog .input-container input');
  const textarea = document.querySelector('.dialog .input-container textarea');
  const select = document.querySelector('.dialog .input-container select');

  if (inputs) {
    inputs.forEach((input) => {
      input.addEventListener('input', () => {
        input.setAttribute('value', input.value);
      });
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
