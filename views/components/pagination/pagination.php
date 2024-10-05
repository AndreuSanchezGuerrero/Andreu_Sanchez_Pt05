<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <ul>
            <!-- Enlace para la página anterior -->
            <?php if ($page > 1): ?>
                <li><a href="?page=<?php echo $page - 1; ?>">Anterior</a></li>
            <?php endif; ?>

            <!-- Enlaces de las páginas -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li><a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <!-- Enlace para la página siguiente -->
            <?php if ($page < $totalPages): ?>
                <li><a href="?page=<?php echo $page + 1; ?>">Siguiente</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>
