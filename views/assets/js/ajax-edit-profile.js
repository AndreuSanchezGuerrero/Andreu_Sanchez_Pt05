import BASE_URL from '../../../config/base-url.js';
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("editProfileForm");
    const saveButton = document.getElementById("saveProfileBtn");

    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("email");
    const bioInput = document.getElementById("bio");
    const profilePicInput = document.getElementById("profilePic");

    const previewUsername = document.getElementById("preview-username");
    const previewEmail = document.getElementById("preview-email");
    const previewBio = document.getElementById("preview-bio");
    const previewProfilePic = document.getElementById("preview-profilePic");

    function updatePreview() {
        previewUsername.textContent = usernameInput.value;
        previewEmail.textContent = emailInput.value;
        previewBio.textContent = bioInput.value;
    }

    usernameInput.addEventListener("input", updatePreview);
    emailInput.addEventListener("input", updatePreview);
    bioInput.addEventListener("input", updatePreview);

    profilePicInput.addEventListener("change", function () {
        const file = profilePicInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewProfilePic.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    saveButton.addEventListener("click", function () {
        const formData = new FormData(form);

        fetch(`${BASE_URL}controllers/ajax/update-profile-ajax.php`, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.text())
            .then((data) => {
                console.log("Server response:", data);
                try {
                    const jsonData = JSON.parse(data);

                    if (jsonData.success) {
                        showAlert(jsonData.message, "success");
                    } else {
                        showAlert(jsonData.message, "error");
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    showAlert("Unexpected error occurred while updating the profile.", "error");
                }
            })
            .catch((error) => {
                console.error("Error en la solicitud AJAX:", error);
                showAlert("Network error occurred. Please try again later.", "error");
            });
    });
});
