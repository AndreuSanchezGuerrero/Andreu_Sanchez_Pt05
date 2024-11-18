
<header>
    <nav class="navbar">        
        <a href="<?php echo BASE_URL; ?>index.php" class="nav-link">
            <i class="fas fa-home icon-house"></i>
        </a>

        <div class="nav-title">
            ONLINE LIBRARY
        </div>

        <div class="profile-menu">
            <?php if (CustomSessionHandler::get('username') =='admin'): ?>
                <img src="<?php echo BASE_URL; ?>views/assets/img/admin.png" alt="Admin" class="admin-icon"> 
            <?php else: ?>
                <img src="<?php echo BASE_URL; ?>views/assets/img/<?php echo CustomSessionHandler::get('user_id') ? 'positive.png' : 'interrogant.png'; ?>" 
                alt="User" class="profile-icon">
            <?php endif; ?>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="<?php echo BASE_URL; ?>index.php" class="dropdown-link"> HOME <i class="fas fa-home"></i></a>
                
                <?php if (CustomSessionHandler::get('user_id')): ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/user_profile/userProfile.php" class="dropdown-link"> PROFILE <i class="fas fa-user"></i></a>
                    <a href="<?php echo BASE_URL; ?>views/auth/logout/logout.php" class="dropdown-link"> LOGOUT <i class="fas fa-times"></i></a>
                <?php elseif (basename($_SERVER['PHP_SELF']) !== 'login.php'): ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/login/login.php" class="dropdown-link"> LOGIN <i class="fas fa-sign-in-alt"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script src="<?php echo BASE_URL; ?>views/components/shared/togglemenu.js"></script>

<script>
    <?php if (CustomSessionHandler::get('username') =='admin'): ?>
        document.addEventListener("DOMContentLoaded", function() {
            setupToggleMenu('.admin-icon', '.dropdown-menu');
        });
    <?php else: ?>
        document.addEventListener("DOMContentLoaded", function() {
            setupToggleMenu('.profile-icon', '.dropdown-menu');
        });
    <?php endif; ?>
</script>


