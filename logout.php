<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION['login'] = "";
    header('Location: index.php');
    exit;
?>