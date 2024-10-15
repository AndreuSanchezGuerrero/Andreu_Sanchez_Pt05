
<header>
    <nav class="navbar">
        <a href="index.php" class="nav-link">
            <i class="fas fa-home icon-house"></i>
        </a>

        <!-- Título centrado -->
        <div class="nav-title">
            ONLINE LIBRARY
        </div>

        <div class="profile-menu">
            <img src="views/img/positive.png" alt="User" class="profile-icon">
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="index.php" class="dropdown-link"> HOME <i class="fas fa-home"></i></a>
                <?php if (CustomSessionHandler::get('user_id')): ?>
                    <a href="index.php?action=logout" class="dropdown-link"> LOGOUT <i class="fas fa-times"></i></a>
                <?php else: ?>
                    <a href="index.php?action=login" class="dropdown-link"> LOGIN <i class="fas fa-sign-in-alt"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script src="views/components/shared/togglemenu.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setupToggleMenu('.profile-icon', '.dropdown-menu');
    });
</script>


