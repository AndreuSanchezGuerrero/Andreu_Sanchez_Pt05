<?php
// Andreu Sánchez Guerrero
// Verificar si hi ha una sessió activa, si no, la creem
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CustomSessionHandler {
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}
?>
