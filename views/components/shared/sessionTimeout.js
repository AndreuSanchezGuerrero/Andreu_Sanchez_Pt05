let sessionTimeout = 40 * 1000 * 60; 
let warningTime = 5 * 60 * 1000; 

setTimeout(() => {
    let extendSession = confirm("Su sesión está por expirar. ¿Desea continuar?");
    if (extendSession) {
        fetch('controllers/extendSessionController.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("La sesión se ha extendido.");
                } else {
                    alert("Hubo un problema extendiendo la sesión.");
                }
            });
    } else {
        window.location.href = 'components/views/auth/logout/logout.php';
    }
}, sessionTimeout - warningTime);
