// Toggle sidebar on mobile
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const buttonSidebar = document.querySelector('.button-sidebar');
    
    if (buttonSidebar) {
        buttonSidebar.addEventListener('click', function(e) {
            e.preventDefault();
            if (sidebar) {
                sidebar.classList.toggle('sidebar-toggle');
            }
        });
    }
});
