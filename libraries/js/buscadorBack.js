function showDiv(val) {
    // Primero ocultamos todos los divs
    document.getElementById('alcaldia').style.display = 'none';
    document.getElementById('deporte').style.display = 'none';
    document.getElementById('costo').style.display = 'none';
    document.getElementById('gradas').style.display = 'none';
    document.getElementById('mascota').style.display = 'none';

    // Mostramos solo el div correspondiente
    if (val == 1) {
        document.getElementById('alcaldia').style.display = 'inline-block';
    } else if (val == 2) {
        document.getElementById('deporte').style.display = 'inline-block';
    } else if (val == 3) {
        document.getElementById('costo').style.display = 'inline-block';
    } else if (val == 4) {
        document.getElementById('gradas').style.display = 'inline-block';
    } else if (val == 5) {
        document.getElementById('mascota').style.display = 'inline-block';
    }
}