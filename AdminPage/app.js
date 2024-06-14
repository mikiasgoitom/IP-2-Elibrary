document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var sidebar = document.querySelector('.sidebar');
  
    function toggleSidebar() {
      if (window.innerWidth <= 768) {
        if (menuToggle.checked) {

          sidebar.style.display = 'block';
        } else {

          sidebar.style.display = 'none';
        }
      } else {
        sidebar.style.display = 'block';
      }
    }
    toggleSidebar();
    menuToggle.addEventListener('change', toggleSidebar);
    window.addEventListener('resize', toggleSidebar);
  });
   