$(document).ready(function() {
    // Function to load books via AJAX
    function loadBooks(page = 1, booksPerPage = $('#booksPerPage').val()) {
        $.ajax({
            url: 'index.php', // Target PHP script
            type: 'GET',
            data: {
                page: page,
                booksPerPage: booksPerPage,
                ajax: true // Flag to indicate an AJAX request
            },
            dataType: 'json',
            success: function(response) {
                // Update table rows with new book data
                $('#book-table tbody').html(response.tableData);
                // Update pagination controls (top and bottom)
                $('#pagination-controls').empty().html(response.pagination);
                $('#pagination-controls2').empty().html(response.pagination2);
            
            },                       
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al cargar los libros: ' + textStatus + " - " + errorThrown);
            }
        });
    }

    // Event handler for pagination link clicks
    $(document).on('click', '.pagination-link', function(e) {
        e.preventDefault(); 
        let page = $(this).data('page');
        console.log("Cargando página:", page);
        loadBooks(page);
    });

    // Event handler for "items per page" dropdown change
    $('#booksPerPage').change(function() {
        loadBooks(1, $(this).val());
    });
});
