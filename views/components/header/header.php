<?php 
    // Obtener el nombre base del archivo actual
    $basename = basename($_SERVER['PHP_SELF']);
?>
<header>
    <nav class="navbar">        
        <div class="nav-left">
            <a href="<?php echo BASE_URL; ?>index.php" class="nav-link">
                <img 
                    src="<?php echo BASE_URL; ?>views/assets/img/<?php echo CustomSessionHandler::get('profile') ? 'home.svg' : 'home-blue.svg'; ?>" 
                    alt="Home Icon" 
                    class="<?php echo CustomSessionHandler::get('profile') ? 'icon-user' : 'icon-home'; ?>">
            </a>
        </div>

        <div class="profile-menu">
            <img    src="<?php echo BASE_URL; ?>views/assets/img/<?php echo CustomSessionHandler::get('profile') ? 'profile-blue.svg' : 'profile.svg'; ?>" 
                    alt="User Icon" 
                    class="<?php echo CustomSessionHandler::get('profile') ? 'icon-home' : 'icon-user'; ?>">

            <div class="dropdown-menu" id="dropdownMenu">
                <?php if (CustomSessionHandler::get('user_id')): ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/user_profile/userProfile.php" class="dropdown-link"> PROFILE <i class="fas fa-user"></i></a>
                    <a href="<?php echo BASE_URL; ?>views/auth/logout/logout.php" class="dropdown-link"> LOGOUT <i class="fas fa-times"></i></a>
                <?php elseif (basename($_SERVER['PHP_SELF']) !== 'login.php'): ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/login/login.php" class="dropdown-link"> SIGN IN <i class="fas fa-sign-in-alt"></i></a>
                    <a href="<?php echo BASE_URL; ?>views/auth/register/register.php" class="dropdown-link"> SIGN UP <i class="fas fa-user-plus"></i></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="nav-title">Kelsier Library</div>

        <div class="nav-right">
            <img 
                src="<?php echo BASE_URL; ?>views/assets/img/tintero-pluma.svg" 
                alt="Tintero Icon" 
                class="icon-tintero">
        </div>
    </nav>
</header>

<script src="<?php echo BASE_URL; ?>views/components/shared/togglemenu.js"></script>

<?php if (!in_array($basename, ['login.php', 'register.php', 'userProfile.php'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setupToggleMenu('.icon-user', '.dropdown-menu');
        });
    </script>
<?php endif; ?>


