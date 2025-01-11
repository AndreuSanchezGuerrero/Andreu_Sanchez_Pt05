document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-users");
    const userTableBody = document.querySelector(".centered-container .table tbody");

    searchInput.addEventListener("input", function () {
        const query = searchInput.value.trim();

        fetch(`index.php?action=searchUsers&ajax=true&query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                userTableBody.innerHTML = data.tableData;
            })
            .catch(error => {
                console.error("Error al buscar usuarios:", error);
            });
    });
});
