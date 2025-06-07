import './bootstrap';

import.meta.glob([
    '../images/**',
  ]);


document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("mobile-toggle");
  const menu = document.getElementById("navbar-sticky");

  toggleBtn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });
});
