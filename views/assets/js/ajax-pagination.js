$(document).ready(function () {
    // Variables globales para mantener el estado
    let currentColumn = null;
    let currentOrder = null;
    let currentPage = 1;

    // Función principal para cargar libros (paginación y ordenación)
    function loadBooks(page = currentPage, booksPerPage = $('#booksPerPage').val(), column = currentColumn, order = currentOrder) {
        console.log('Datos enviados al servidor:', {
            page: page,
            booksPerPage: booksPerPage,
            column: column,
            order: order
        });

        $.ajax({
            url: 'index.php',
            type: 'GET',
            data: {
                ajax: true,
                page: page,
                booksPerPage: booksPerPage,
                column: column,
                order: order
            },
            dataType: 'json',
            success: function (response) {
                console.log('Respuesta recibida del servidor:', response);

                // Actualizar la tabla de libros
                $('#book-table tbody').html(response.tableData);

                // Actualizar los controles de paginación
                $('#pagination-controls').empty().html(response.pagination);
                $('#pagination-controls2').empty().html(response.pagination);

                // Actualizar estado global
                currentPage = page;
                currentColumn = response.column || currentColumn; // Mantener columna si no cambia
                currentOrder = response.order || currentOrder;    // Mantener orden si no cambia
            },
            error: function (textStatus, errorThrown) {
                console.error('Error al cargar los libros:', textStatus, errorThrown);
                alert('Error al cargar los libros: ' + textStatus + ' - ' + errorThrown);
            }
        });
    }

    // Manejar clics en los enlaces de paginación
    $(document).on('click', '.pagination-link', function (e) {
        e.preventDefault();
        let page = $(this).data('page');
        console.log('Cambiando a la página:', page);
        loadBooks(page, $('#booksPerPage').val(), currentColumn, currentOrder);
    });

    // Manejar cambio en libros por página
    $('#booksPerPage').change(function () {
        let booksPerPage = $(this).val();
        console.log('Cambiando libros por página a:', booksPerPage);
        loadBooks(1, booksPerPage, currentColumn, currentOrder); // Reiniciar a la primera página
    });

    // Manejar clics en los íconos de ordenación
    $(document).on('click', '.sort-icon', function () {
        const column = $(this).data('column');
        const order = $(this).data('order') === 'asc' ? 'desc' : 'asc';

        // Cambiar el atributo para el próximo clic
        $(this).data('order', order);
        console.log('Ordenando por columna:', column, 'en orden:', order);

        // Reiniciar a la primera página al ordenar
        loadBooks(1, $('#booksPerPage').val(), column, order);
    });
});
