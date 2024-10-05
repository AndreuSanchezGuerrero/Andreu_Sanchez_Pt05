function showAlert(mensaje, tipo = 'success') {

    const alert = document.getElementById('alert');

    alert.textContent = mensaje;

    alert.classList.remove('success');
    if (tipo === 'error') {
        alert.classList.add('error');
    } else {
        alert.classList.remove('error');
    }

    alert.style.display = 'block';

    setTimeout(() => {
        alert.classList.add('show');
    }, 10);

    setTimeout(() => {
        alert.classList.remove('show');
        setTimeout(() => {
            alert.style.display = 'none'; 
        }, 1000); 
    }, 3000); 
}