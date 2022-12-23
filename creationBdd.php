<?php
    include 'Donnees.inc.php';

    /*Création de la base de donnée*/

    $mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
    $base="Cocktails";

    $requete = "CREATE DATABASE IF NOT EXISTS $base";
    if ($mysqli->query($requete) === TRUE) {
        echo "<script>console.log('Base de données créée correctement\n');</script>";
    } else {
        echo "<script>console.log('Erreur lors de la création de la base de données : ' , $mysqli->error , '\n');</script>";
    }

    $mysqli->query("USE $base");


    $requete = "
        CREATE TABLE IF NOT EXISTS Aliment(
            nomAliment varchar(50) NOT NULL,
            pereAliment varchar(50) NOT NULL,
            PRIMARY KEY(nomAliment)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    if(!$stmt){
        echo "<script>console.log('Préparation ratée : (', $mysqli->errno,') ',$mysqli->error,'\n');</script>";
    }
    $stmt->execute();
    
    $requete = "
        CREATE TABLE IF NOT EXISTS Cocktail (
            nomCocktail varchar(100) NOT NULL,
            preparationCocktail varchar(1000) NOT NULL,
            ingredients varchar(800) NOT NULL,
            nomAlimentsC varchar(200) NOT NULL,
            PRIMARY KEY(nomCocktail),
            CONSTRAINT key_alimentC FOREIGN KEY(nomAlimentsC) REFERENCES Aliment(nomAliment)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    if(!$stmt){
        echo "<script>console.log('Préparation ratée : (', $mysqli->errno,') ',$mysqli->error,'\n');</script>";
    }
    $stmt->execute();
   
    $requete = "
    CREATE TABLE IF NOT EXISTS Utilisateur(
            login varchar(50) NOT NULL,
            mdp varchar(50) NOT NULL,    
            PRIMARY KEY (login)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    if(!$stmt){
        echo "<script>console.log('Préparation ratée : (', $mysqli->errno,') ',$mysqli->error,'\n');</script>";
    }
    $stmt->execute();

    $requete = "
        CREATE TABLE IF NOT EXISTS Liaison(
            nomAlimentL varchar(50),
            nomCocktailL varchar(50),
            PRIMARY KEY (nomAlimentL, nomCocktailL),
            CONSTRAINT key_aliment FOREIGN KEY(nomAlimentL) REFERENCES Aliment(nomAliment),
            CONSTRAINT key_cocktailL FOREIGN KEY(nomCocktailL) REFERENCES Cocktail(nomCocktail)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    if(!$stmt){
        echo "<script>console.log('Préparation ratée : (', $mysqli->errno,') ',$mysqli->error,'\n');</script>";
    }
    $stmt->execute();

    $requete = "
        CREATE TABLE IF NOT EXISTS Panier(
            loginP varchar(50),
            nomCocktailsP varchar(100),
            dateAjout date,
            PRIMARY KEY(loginP, nomCocktailP),
            CONSTRAINT key_login FOREIGN KEY(loginP) REFERENCES Utilisateur(login),
            CONSTRAINT key_cocktail FOREIGN KEY(nomCocktailP) REFERENCES Cocktail(nomCocktail)
        );
    ";
    $stmt = $mysqli->prepare($requete);
    if(!$stmt){
        echo "<script>console.log('Préparation ratée : (', $mysqli->errno,') ',$mysqli->error,'\n');</script>";
    }
    $stmt->execute();
    //echo "<script>console.log('test : ". $mysqli->error ."')</script>";


    //Remplissage d'utilisateur test
    $login = "sandy";
    $mdp = "test";
    $stmt = $mysqli->prepare("INSERT INTO Utilisateur(login, mdp) values (?,?)");
    if(!$stmt){
        echo "<script>console.log('Préparation ratée : (', $mysqli->errno,') ',$mysqli->error,'\n');</script>";
    }
    $stmt->bind_param("ss", $login, $mdp);
    $stmt->execute();
    mysqli_stmt_close($stmt);
    

    //Remplissage des catégories
    foreach ($Hierarchie as $nom => $alimentT){
        if (isset($alimentT['super-categorie'])){
            foreach ($alimentT['super-categorie'] as $cat => $pere){
                $stmt = $mysqli->prepare("INSERT INTO Aliment(nomAliment, pereAliment) values (?,?)");
                $stmt->bind_param("ss", $nom, $pere);
                $stmt->execute();
                mysqli_stmt_close($stmt);
            }
        }
    }

    //Remplissage des cocktails
    foreach ($Recettes as $tmp => $cocktail){
        $string = implode('|', $cocktail['index']);
        $stmt = $mysqli->prepare("INSERT INTO Cocktail(nomCocktail, preparationCocktail, ingredients, nomAlimentsC) values (?,?,?,?)");
        $stmt->bind_param("ssss", $cocktail['titre'], $cocktail['ingredients'], $cocktail['preparation'], $string);
        $stmt->execute();
        mysqli_stmt_close($stmt);
    }

    mysqli_close($mysqli);
?>