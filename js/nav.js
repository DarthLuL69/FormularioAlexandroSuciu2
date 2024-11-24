document.addEventListener('DOMContentLoaded', function() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'nav.html', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.body.insertAdjacentHTML('afterbegin', xhr.responseText);
                resaltarPaginaActual();
            } else {
                console.error('Failed to load navigation bar');
            }
        }
    };
    xhr.send();

    function resaltarPaginaActual() {
        const paginaActual = window.location.pathname.split('/').pop();
        document.querySelectorAll('nav ul li a').forEach(item => {
            if (item.getAttribute('href') === paginaActual) {
                item.style.color = 'red';
            }
        });
    }
});