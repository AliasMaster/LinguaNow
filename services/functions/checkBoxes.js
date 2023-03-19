function onchangeCheckBox(role) {
  let allChecked = true;
  let noneChecked = true;

  const checkboxes = document.querySelectorAll(`.${role}-checkBox`);
  const mainCheckBox = document.querySelector(`.${role}Main-checkBox`);
  const mainCheckBoxIcon = document.querySelector(
    `.${role}Main-checkBox .icon`,
  );

  // check if all checkboxes are checked
  checkboxes.forEach((checkBox) => {
    if (!checkBox.classList.contains('active')) {
      allChecked = false;
      return;
    }
  });

  if (allChecked) {
    mainCheckBox.classList.remove('indeterminate');
    mainCheckBox.classList.add('active');
    mainCheckBoxIcon.textContent = 'check';
  } else {
    // check if all checkboxes are not checked
    checkboxes.forEach((checkBox) => {
      if (checkBox.classList.contains('active')) {
        noneChecked = false;
        return;
      }
    });

    if (noneChecked) {
      mainCheckBox.classList.remove('active');
      mainCheckBox.classList.remove('indeterminate');
      mainCheckBoxIcon.textContent = 'check';
    } else {
      mainCheckBox.classList.remove('active');
      mainCheckBox.classList.add('indeterminate');
      mainCheckBoxIcon.textContent = 'check_indeterminate_small';
    }
  }
}

function selectAllCheckBoxes(headerCheckBox, role) {
  const mainCheckBoxIcon = document.querySelector(
    `.${role}Main-checkBox .icon`,
  );

  if (
    headerCheckBox.classList.contains('indeterminate') ||
    !headerCheckBox.classList.contains('active')
  ) {
    headerCheckBox.classList.remove('indeterminate');
    headerCheckBox.classList.add('active');
    mainCheckBoxIcon.textContent = 'check';
  } else {
    headerCheckBox.classList.remove('indeterminate');
    headerCheckBox.classList.remove('active');
    mainCheckBoxIcon.textContent = 'check';
  }

  const checkBoxes = document.querySelectorAll(`.${role}-checkBox`);

  if (headerCheckBox.classList.contains('active')) {
    checkBoxes.forEach((checkBox) => {
      checkBox.classList.add('active');
    });
  } else {
    checkBoxes.forEach((checkBox) => {
      checkBox.classList.remove('active');
    });
  }
}

export { onchangeCheckBox, selectAllCheckBoxes };
