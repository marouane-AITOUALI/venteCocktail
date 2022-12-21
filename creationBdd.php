<?php
    include 'Donnees.inc.php';

    /*Création de la base de donnée*/

    $mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
    $base="Cocktails";

    $requete = "
        DROP DATABASE IF EXISTS $base;
        CREATE DATABASE $base;
        USE $base;
    ";
    $stmt = $mysqli->prepare($requete);
    $stmt->execute();

    $requete = "
        CREATE TABLE IF NOT EXISTS aliment (
            nomAliment varchar(50) NOT NULL,
            pereAliment varchar(50) NOT NULL
            PRIMARY KEY(nomAliment)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    $stmt->execute();
    
    $requete = "
        CREATE TABLE IF NOT EXISTS cocktail (
            nomCocktail varchar(50) NOT NULL,
            preparationCocktail varchar(50) NOT NULL,
            ingredient varchar(50) NOT NULL,
            liquide varchar(50) NOT NULL,
            PRIMARY KEY(nomCocktail)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    $stmt->execute();
   
    $requete = "
        CREATE TABLE IF NOT EXISTS utilisateur(
            nom varchar(50) NOT NULL,
            prenom varchar(50) NOT NULL,
            login varchar(50) NOT NULL,
            adresseMail varchar(50) NOT NULL,
            adresse varchar(50) NOT NULL,       
            PRIMARY KEY (login)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    $stmt->execute();

    $requete = "
        CREATE TABLE IF NOT EXISTS panier(
            loginP varchar(50) NOT NULL,
            nomCocktailsP varchar(50),
            dateAjout date,
            PRIMARY KEY(loginP, nomCocktailP)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    $stmt->execute();

    $requete = "
        CREATE TABLE IF NOT EXISTS liaison(
            nomAlimentL
            nomCocktailL
            PRIMARY KEY (nomAlimentL, nomCocktailL)  
        );
    ";
    $stmt = $mysqli->prepare($requete);
    $stmt->execute();

    
    foreach ($Hierarchie as $nom => $alimentT){
        if (isset($alimentT['super-categorie'])){
            foreach ($alimentT['super-categorie'] as $cat => $pere){
                $stmt = $mysqli->prepare("INSERT INTO Aliment(nomAliment, pereAliment) values $cat, $nom");
                $stmt->bind_param("ss", $nom, $pere);
                $stmt->execute();
                mysqli_stmt_close($stmt);
            }
        }
    }

    mysqli_close($mysqli);
?>