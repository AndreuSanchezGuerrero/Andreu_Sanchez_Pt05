// $(document).ready(function () {
//     let currentColumn = null;
//     let currentOrder = null;
//     let currentPage = 1;

//     function fetchBooks(column = currentColumn, order = currentOrder, page = currentPage, limit = $('#booksPerPage').val()) {
//             console.log('Datos enviados al servidor:', {
//         column: column,
//         order: order,
//         page: page,
//         booksPerPage: limit
//     });
//         $.ajax({
//             url: 'index.php',
//             type: 'GET',
//             data: {
//                 ajax: true,
//                 column: column,
//                 order: order,
//                 page: page,
//                 booksPerPage: limit
//             },
//             success: function (response) {
//                 // Actualizar la tabla de libros
//                 $('#book-table tbody').html(response.tableData);

//                 // Actualizar los controles de paginación
//                 $('#pagination-controls').html(response.pagination);
//                 $('#pagination-controls2').html(response.pagination);

//                 // Actualizar estado global
//                 currentColumn = response.column;
//                 currentOrder = response.order;
//                 currentPage = response.currentPage;
//             },
//             error: function (error) {
//                 console.error('Error en la solicitud:', error);
//             }
//         });
//     }

//     // Manejar clics en las columnas para ordenar
//     $('.sort-icon').on('click', function () {
//         console.log('Ordenando por columna:', $(this).data('column'));
//         const column = $(this).data('column');
//         const order = $(this).data('order') === 'asc' ? 'desc' : 'asc';

//         $(this).data('order', order);
//         fetchBooks(column, order, 1);
//     });

//     $(document).on('click', '.pagination-link', function (e) {
//         console.log('Cambiando de página:', $(this).data('page'));
//         e.preventDefault();
//         const page = $(this).data('page');
//         fetchBooks(currentColumn, currentOrder, page);
//     });

//     // Manejar cambio en libros por página
//     $('#booksPerPage').change(function () {
//         fetchBooks(currentColumn, currentOrder, 1); // Reiniciar a la primera página
//     });
// });
