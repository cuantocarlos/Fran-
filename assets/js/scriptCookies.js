
document.addEventListener('DOMContentLoaded', function() {
    var avisoCookies = document.getElementById('avisoCookies');
    var aceptarCookies = document.getElementById('aceptarCookies');

    // Muestra el aviso si la cookie no ha sido aceptada
    if(avisoCookies && aceptarCookies) {
        avisoCookies.style.display = 'block';

        // Agrega un evento al enlace de aceptar cookies
        aceptarCookies.addEventListener('click', function() {
            // Hace una petición al mismo script con el parámetro aceptarCookies=true
            window.location.href = '?aceptarCookies=true';
        });
    }
});
