
let sessionTimeout = 2400; 
let warningTime = 300; 

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
        window.location.href = 'views/auth/logout/logout.php';
    }
}, (sessionTimeout - warningTime)*1000);
