const sidebarToggle = document.querySelector('.sidebar-toggle');
const closeBtn = document.querySelector('.close-btn');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');

sidebarToggle.addEventListener('click', function(event) {
  event.preventDefault();
  sidebar.classList.toggle('active');
  mainContent.classList.toggle('active');
});

closeBtn.addEventListener('click', function(event) {
  event.preventDefault();
  sidebar.classList.remove('active');
  mainContent.classList.remove('active');
});
