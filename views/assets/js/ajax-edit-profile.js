document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("editProfileForm");
    const saveButton = document.getElementById("saveProfileBtn");

    // Selección de los campos y vista previa
    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("email");
    const bioInput = document.getElementById("bio");
    const profilePicInput = document.getElementById("profilePic");
    
    const previewUsername = document.getElementById("preview-username");
    const previewEmail = document.getElementById("preview-email");
    const previewBio = document.getElementById("preview-bio");
    const previewProfilePic = document.getElementById("preview-profilePic");

    // Función para actualizar la vista previa en tiempo real
    function updatePreview() {
        previewUsername.textContent = usernameInput.value;
        previewEmail.textContent = emailInput.value;
        previewBio.textContent = bioInput.value;
    }

    // Escuchar cambios en los campos de texto y actualizarlos en la vista previa
    usernameInput.addEventListener("input", updatePreview);
    emailInput.addEventListener("input", updatePreview);
    bioInput.addEventListener("input", updatePreview);

    // Escuchar el cambio de la foto de perfil
    profilePicInput.addEventListener("change", function() {
        const file = profilePicInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewProfilePic.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Enviar datos mediante AJAX solo al hacer clic en "Guardar"
    saveButton.addEventListener("click", function() {
        if (!form) {
            console.error("Formulario no encontrado");
            return;
        }

        if (form) {
            console.log("Formulario encontrado", form);
        }
        
        const formData = new FormData(form);
    
        fetch("/Backend/Andreu_Sanchez_Pt05/controllers/ajax/update-profile-ajax.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.text()) // Cambiado a `text()` para ver la respuesta completa
        .then(data => {
            console.log("Server response:", data); // Verifica que sea JSON limpio sin etiquetas HTML
            try {
                const jsonData = JSON.parse(data); // Intentar parsear como JSON
                if (jsonData.success) {
                    alert("Profile updated successfully!");
                } else {
                    alert("Error updating profile: " + jsonData.message);
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        });        
    });
});
