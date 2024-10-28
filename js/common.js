window.addEventListener('message', function(event) {
    if (event.data === 'toggleSidebar') {
        const sidebar = document.getElementById('sidebar');
        sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
    }
});
