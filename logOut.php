<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    foreach ($_SESSION as $index => $item) {
        unset($_SESSION[$index]);
    }
    session_destroy();
    session_unset();
    header("Location: index.php");
}

?>