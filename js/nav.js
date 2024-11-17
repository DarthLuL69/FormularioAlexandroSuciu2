document.addEventListener('DOMContentLoaded', function() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'nav.html', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.body.insertAdjacentHTML('afterbegin', xhr.responseText);
                highlightCurrentPage();
            } else {
                console.error('Failed to load navigation bar');
            }
        }
    };
    xhr.send();

    function highlightCurrentPage() {
        const navItems = document.querySelectorAll('nav ul li a');
        const currentPage = window.location.pathname.split('/').pop();
        navItems.forEach(item => {
            if (item.getAttribute('href') === currentPage) {
                item.style.color = 'red'; // Highlight the current page
            }
        });
    }
});