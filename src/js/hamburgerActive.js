const hamburger = document.querySelector('.hamburger');

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('clicked');
});

function eventListenerForNavItems() {
  const navItems = document.querySelectorAll('.navItem');

  if (navItems) {
    navItems.forEach((navItem) => {
      navItem.addEventListener('click', () => {
        hamburger.classList.remove('clicked');
      });
    });
  }
}

window.eventListenerForNavItems = eventListenerForNavItems;
