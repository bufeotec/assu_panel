// Función para cambiar la imagen del logo según el tema
function changeLogo() {
    const logo = document.getElementById('logo');
    if (document.documentElement.classList.contains('dark')) {
        logo.src = "/logo_blanco.png"; // Ruta relativa para el logo en modo oscuro
    } else {
        logo.src = "/logo.png"; // Ruta relativa para el logo en modo claro
    }
}

// Al cargar la página, o cuando se cambien los temas
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
    changeLogo(); // Cambiar logo cuando el modo oscuro está activado
} else {
    document.documentElement.classList.remove('dark');
    changeLogo(); // Cambiar logo cuando el modo claro está activado
}

var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Cambiar el icono dentro del botón según la configuración previa
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');
themeToggleBtn.addEventListener('click', function() {
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }

    // Cambiar el logo cuando el tema cambie
    changeLogo();
});
