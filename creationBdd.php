<?php
    include 'Donnees.inc.php';

    /*Création de la base de donnée*/
    function query($link,$requete)
    { 
        $resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
        return($resultat);
    }

  
    $mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
    $base="Cocktails";
    $Sql="
            DROP DATABASE IF EXISTS $base;
            CREATE DATABASE $base;
            USE $base;
        
            CREATE TABLE aliment (
                nomAliment varchar(50) NOT NULL,
                preparationAliment varchar(50) NOT NULL
                PRIMARY KEY(nomAliment)
            );

            CREATE TABLE cocktail (
                nomCocktail varchar(50) NOT NULL,
                preparationCocktail varchar(50) NOT NULL,
                ingredient varchar(50) NOT NULL,
                liquide varchar(50) NOT NULL,
                PRIMARY KEY(nomCocktail)
            );

            CREATE TABLE utilisateur(
                nom varchar(50) NOT NULL,
                prenom varchar(50) NOT NULL,
                adresseMail varchar(50) NOT NULL,
                adresse varchar(50) NOT NULL,       
                PRIMARY KEY (nom)
            );

            CREATE TABLE panier(
                login varchar(50) NOT NULL,
                mdp varchar(50) NOT NULL,
                nomCocktailsPanier varchar(50),
                PRIMARY KEY(login)
            );

            CREATE TABLE liaison(
                nomAliment
                nomCocktail
                mail
                nomCocktailsPanier
                PRIMARY KEY (mail),
                FOREIGN KEY (nomAliment) REFERENCES ALIMENT(nomAliment),
                FOREIGN KEY (nomCocktail) REFERENCES COCKTAIL(nomCocktail),
                FOREIGN KEY (mail) REFERENCES UTILISATEUR(mail),
                FOREIGN KEY (nomCocktailsPanier) REFERENCES PANIER(nomCocktailsPanier),
            );

    foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

    mysqli_close($mysqli);
?>