<!-- Andreu Sánchez Guerrero -->
<div class="col-6">
    <h2 id="margin">Llista de Llibres</h2>  <!-- Cambiado a Llibres -->
    <?php if (!empty($books)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Nom del Llibre</th>
                    <th>Autor</th> 
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>  <!-- Cambiado a books -->
                    <tr>
                        <td><?= htmlspecialchars($book['isbn']); ?></td>  <!-- Cambiado a book -->
                        <td><?= htmlspecialchars($book['name']); ?></td>  <!-- Cambiado a name -->
                        <td><?= htmlspecialchars($book['author']); ?></td>  <!-- Cambiado a author -->
                        <td class="text-right">
                            <!-- Enlaces para editar y eliminar libros -->
                            <a href="index.php?action=edit&id=<?= $book['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="index.php?action=delete&id=<?= $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hi ha llibres disponibles.</p>  <!-- Cambiado a llibres -->
    <?php endif; ?>

    <!-- Incluir componente de paginación -->
    <?php include __DIR__ . '/../pagination/pagination.php'; ?>
</div>
