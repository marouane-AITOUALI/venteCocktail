<?php
    session_start();
    $compte = "Compte";
    if (isset($_SESSION['login'])){
        $compte = $_SESSION['login'];
    }

    $cocktail = $_GET['cocktail'];

    //supprimer ligne de la table
?>