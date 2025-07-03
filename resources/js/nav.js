function toggleMenu() {
    var menu = document.querySelector('.menu ul');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
<button class="hamburger" onclick="toggleMenu()">☰</button>
    <script>
        function toggleMenu() {
            var sidebar = document.querySelector('.menu');
            sidebar.classList.toggle('show-menu');
        }
    </script>