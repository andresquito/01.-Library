function initializeDarkMode() {
    const isDarkMode = sessionStorage.getItem('isDarkMode') === 'true';
    const isInputChecked = isDarkMode;  // Usamos la variable de sesión directamente

    updateStyles(isInputChecked); // Utiliza isInputChecked aquí
    document.getElementById('dark-version').checked = isInputChecked;

    document.getElementById('dark-version').addEventListener('change', function() {
        const isChecked = this.checked;
        sessionStorage.setItem('isDarkMode', isChecked);  // Almacenamos el estado en sessionStorage
        updateStyles(isChecked); // Utiliza isChecked aquí
    });

    function updateStyles(isInputChecked) {
        const body = document.body;

        // Agrega lógica para actualizar estilos según el estado del checkbox
        if (isInputChecked) {
            // Aplica estilos para cuando el checkbox está marcado
            body.classList.add('dark-mode');
            // Agrega lógica adicional si es necesario
        } else {
            // Aplica estilos para cuando el checkbox no está marcado
            body.classList.remove('dark-mode');
            // Agrega lógica adicional si es necesario
        }

        // Puedes agregar más lógica aquí para actualizar estilos de otros elementos si es necesario
    }
}

// Llama a la función cuando se carga el DOM
document.addEventListener('DOMContentLoaded', initializeDarkMode);
