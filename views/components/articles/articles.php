<!-- Andreu Sánchez Guerrero -->
<div class="col-6">
    <h2 id="margin">Llista d'Articles</h2>
    <?php if (!empty($articles)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Títol</th>
                    <th>Cos</th> 
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['id']); ?></td>
                        <td><?= htmlspecialchars($article['title']); ?></td>
                        <td><?= htmlspecialchars(substr($article['body'], 0, 50)); ?>...</td> <!-- Mostra els primers 50 caràcters i després 3 puntets -->
                        <td class="text-right"> <!-- Alineem els icones a la dreta -->
                            <!-- Enllaços per editar i eliminar articles -->
                            <a href="index.php?action=edit&id=<?= $article['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="index.php?action=delete&id=<?= $article['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Estàs segur que vols eliminar aquest article?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hi ha articles disponibles.</p>
    <?php endif; ?>

    <!-- Incloure component de paginació. Fem servir DIR per fer servir la ruta relativa -->
    <?php include __DIR__ . '/../pagination/pagination.php'; ?>
</div>