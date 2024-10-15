<?php
// Andreu Sánchez Guerrero
// Verificar si hi ha una sessió activa, si no, la creem
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Classe per controlar la sessió
class CustomSessionHandler
{
    // Per afegir un valor a la sessió
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // Per obtenir un valor de la sessió
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Per eliminar un valor de la sessió
    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}
?>
