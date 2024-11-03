<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <ul>
            <!-- Previous Button -->
            <?php if ($page > 1): ?>
                <li><a href="#" data-page="<?php echo $page - 1; ?>" class="pagination-link">Previous</a></li>
            <?php endif; ?>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li><a href="#" data-page="<?php echo $i; ?>" class="pagination-link <?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <!-- Next Button -->
            <?php if ($page < $totalPages): ?>
                <li><a href="#" data-page="<?php echo $page + 1; ?>" class="pagination-link">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>
