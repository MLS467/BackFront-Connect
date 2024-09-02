function mostrarCampos() {
    let cargo = document.getElementById('cargo').value;

    let camposEspecificos = document.querySelectorAll('.campo-especifico');
    camposEspecificos.forEach(function (campo) {
        campo.style.display = 'none';
    });

    if (cargo) {
        document.querySelector('.' + cargo).style.display = 'block';
    }
} function mostrarCampos() {
    let cargo = document.getElementById('cargo').value;

    let camposEspecificos = document.querySelectorAll('.campo-especifico');
    camposEspecificos.forEach(function (campo) {
        campo.style.display = 'none';
    });

    if (cargo) {
        document.querySelector('.' + cargo).style.display = 'block';
    }
}