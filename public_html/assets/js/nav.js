// Selecciona el botón de hamburguesa y el menú de navegación
let hamburger = document.querySelector('.hamburger');
let dropdownMenu = document.querySelector('.dropdown-menu');

console.log(hamburger, dropdownMenu); // Imprime los elementos seleccionados en la consola

// Agrega un evento de escucha para el evento 'click'
hamburger.addEventListener('click', function(event) {
    // Evita que el evento se propague
    event.stopPropagation();

    // Comprueba si el menú desplegable tiene la clase 'show'
    if (dropdownMenu.classList.contains('show')) {
        // Si la tiene, quítala
        dropdownMenu.classList.remove('show');
        console.log("cerrado")
    } else {
        // Si no la tiene, agrégala
        dropdownMenu.classList.add('show');
        console.log("Hecho");
    }
});

// Agrega un evento de escucha al body del documento
document.body.addEventListener('click', function() {
    // Si el menú desplegable tiene la clase 'show', quítala
    if (dropdownMenu.classList.contains('show')) {
        dropdownMenu.classList.remove('show');
    }
});

console.log('El código ha sido ejecutado'); 