
<header>
    <nav class="navbar">        
        <a href="<?php echo BASE_URL; ?>index.php" class="nav-link">
            <i class="fas fa-home icon-house"></i>
        </a>

        <!-- Título centrado -->
        <div class="nav-title">
            ONLINE LIBRARY
        </div>

        <div class="profile-menu">
            <img src="<?php echo BASE_URL; ?>views/img/<?php echo CustomSessionHandler::get('user_id') ? 'positive.png' : 'interrogant.png'; ?>" 
            alt="User" class="profile-icon">

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="<?php echo BASE_URL; ?>index.php" class="dropdown-link"> HOME <i class="fas fa-home"></i></a>
                
                <?php if (CustomSessionHandler::get('user_id')): ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/logout/logout.php" class="dropdown-link"> LOGOUT <i class="fas fa-times"></i></a>
                <?php elseif (basename($_SERVER['PHP_SELF']) !== 'login.php'): ?>
                    <!-- Solo mostrar el enlace de LOGIN si no estamos en la página de login -->
                    <a href="<?php echo BASE_URL; ?>views/auth/login/login.php" class="dropdown-link"> LOGIN <i class="fas fa-sign-in-alt"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script src="<?php echo BASE_URL; ?>views/components/shared/togglemenu.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setupToggleMenu('.profile-icon', '.dropdown-menu');
    });
</script>


