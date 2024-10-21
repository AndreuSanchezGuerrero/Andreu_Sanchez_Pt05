<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $_SESSION['start_time'] = time();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
