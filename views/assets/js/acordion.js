document.addEventListener("DOMContentLoaded", function() {
    const accordion = document.getElementById("togglePasswordFields");
    const passwordFields = document.getElementById("passwordFields");
    const previewPassword = document.getElementById("preview-password");

    accordion.addEventListener("click", function() {
        // Toggle the "active" class to change the symbol (+/-)
        this.classList.toggle("active");

        // Toggle the visibility of the panel
        if (passwordFields.style.maxHeight) {
            passwordFields.style.maxHeight = null; // Close panel
            previewPassword.textContent = "********"; // Reset preview to asterisks
        } else {
            passwordFields.style.maxHeight = passwordFields.scrollHeight + "px"; // Open panel
            previewPassword.textContent = "Modifying password..."; // Show modifying status
        }
    });
});
