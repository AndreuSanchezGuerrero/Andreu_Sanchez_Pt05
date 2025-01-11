$(document).ready(function () {
    let currentColumn = null;
    let currentOrder = null;
    let currentPage = 1;

    function loadBooks(page = currentPage, booksPerPage = $('#booksPerPage').val(), column = currentColumn, order = currentOrder) {
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
                $('#book-cards').html(response.tableData);
                $('#pagination-controls2').html(response.pagination);

                currentPage = page;
                currentColumn = response.column || currentColumn;
                currentOrder = response.order || currentOrder;
                applyCardStyles();
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar los libros:', status, error);
                alert('Error al cargar los libros.');
            }
        });
    }

    $(document).on('click', '.pagination-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page');
        loadBooks(page, $('#booksPerPage').val(), currentColumn, currentOrder);
    });

    $('#booksPerPage').change(function () {
        const booksPerPage = $(this).val();
        loadBooks(1, booksPerPage, currentColumn, currentOrder);
    });

    $(document).on('click', '.sort-icon', function () {
        const column = $(this).data('column');
        const order = $(this).data('order') === 'asc' ? 'desc' : 'asc';
        $(this).data('order', order);
        loadBooks(1, $('#booksPerPage').val(), column, order);
    });
    
    function applyCardStyles() {
        $('.card').each(function () {
            $(this).css({
                'background': '#1E2A38',
                'border-radius': '15px',
                'box-shadow': '0 4px 10px rgba(0, 0, 0, 0.2)',
                'padding': '30px',
                'max-width': '300px',
                'margin': '0 auto'
            });
    
            $(this).find('.card-img').css({
                'width': '100%',
                'height': '200px',
                'border-radius': '20px',
                'margin-bottom': '15px',
                'object-fit': 'cover'
            });
        });
    
        $('.card').hover(
            function () {
                $(this).css({
                    'transform': 'translateY(-5px)',
                    'box-shadow': '0 8px 15px rgba(0, 0, 0, 0.3)'
                });
            },
            function () {
                $(this).css({
                    'transform': 'none',
                    'box-shadow': '0 4px 10px rgba(0, 0, 0, 0.2)'
                });
            }
        );
    }
});


