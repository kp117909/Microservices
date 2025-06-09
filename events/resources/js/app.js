import './bootstrap';

import.meta.glob([
    '../images/**'
  ]);

document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("mobile-toggle");
  const menu = document.getElementById("navbar-sticky");

  toggleBtn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  document.querySelectorAll('[id^="dropdownUsersButton-"]').forEach(button => {
    button.addEventListener('click', function () {
      const eventId = this.getAttribute('data-event-id');
      const dropdown = document.getElementById(`dropdownUsers-${eventId}`);
      dropdown.classList.toggle('hidden');
    });
  });

  document.querySelectorAll('[id^="input-group-search-"]').forEach(input => {
    input.addEventListener('input', function () {
      const eventId = this.getAttribute('data-event-id');
      const list = document.getElementById(`attendees-list-${eventId}`);
      const items = list.querySelectorAll('.attendee-item');
      const search = this.value.toLowerCase();

      items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(search) ? '' : 'none';
      });
    });
  });

  document.addEventListener('click', function (e) {
  document.querySelectorAll('[id^="dropdownUsers-"]').forEach(dropdown => {
    const eventId = dropdown.id.replace('dropdownUsers-', '');
    const button = document.getElementById(`dropdownUsersButton-${eventId}`);

    if (!dropdown.contains(e.target) && !button.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });
});


  document.querySelectorAll('[data-modal-toggle]').forEach(toggleBtn => {
    toggleBtn.addEventListener('click', () => {
      const targetId = toggleBtn.getAttribute('data-modal-toggle');
      const modal = document.getElementById(targetId);
      if (modal) {
        modal.classList.toggle('hidden');
      }
    });
  });

  document.querySelectorAll('[id^="deleteModal-"]').forEach(modal => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });
  });


});
