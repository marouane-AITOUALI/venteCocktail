<?php
    session_start();
    $compte = "Compte";
    if (isset($_SESSION['login'])){
        $compte = $_SESSION['login'];
    }

    $nomCocktail = $_GET['cocktail'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styleElement.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktails</title>
</head>

<body>
    <div id="bandeau" class="bandeau">
        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="index.php" class="logo">COCKTAILS</a>

        <nav>
            <ul>
                <li>
                    <a href='#' id='boutonCompte'><?php echo $compte ?>
                        <img src='./Ressources/logo_compte.png' alt='' class='imgLogoCompte'></a>
                    <ul>    
                        <?php
                            if (!isset($_SESSION['login'])){
                                echo "<li><a href='login.php'>Se connecter</a></li>";
                            } else {
                                echo "<li><a href='logout.php'>Se déconnecter</a></li>";
                            }
                        ?>   
                    </ul>     
                </li>

                <li>
                    <a href='panier.php' id='boutonPanier'>Panier
                        <img src='./Ressources/logo_like.png' alt='' class='imgLogoLike'></a>
                </li>
            </ul>
        </nav>
    </div>

        <div class="contenu">
        <?php
                //Affichage du cocktail à partir de la base de données et du lien
                include 'creationBdd.php';
                $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

                $stmt = $sql->prepare("SELECT * FROM Cocktail WHERE nomCocktail = '$nomCocktail'");
                $stmt->execute();
                $res = $stmt->fetchAll();

                $photo = "Photos/defaut";//Photo de base
                $string = str_replace(" ", "_", stripAccents($res[0]['nomCocktail']));
                if (file_exists("Photos/". $string . ".jpg")){
                    $photo = "Photos/" . $string . ".jpg";
                }

                echo "
                    <img class='image' src='$photo'  alt=''>
                    <div class='texte'>
                        <form action='#' method='POST'>
                        <div id='nomCocktail' name='nomCocktail' class='description'>" . $res[0]['nomCocktail'] . "</div>
                        <h2>Ingredients</h2>";

                        foreach(explode('|', $res[0]['nomAlimentsC']) as $aliment){
                            echo "
                                <li>$aliment</li>
                            ";
                        }
                echo "<br>
                        <h2>Preparation</h2>";
                        foreach(explode('|', $res[0]['preparationCocktail']) as $preparation){
                            echo "
                                <li>$preparation</li>
                            ";
                        }
                        echo "
                        <button type='submit' id='boutonAjouterPanier' name='boutonAjouterPanier' class='boutonAjouterPanier'>Ajouter au panier</button>
                        </form>
                    </div>";

                        

                function stripAccents($texte) {
                    $texte = str_replace(
                        array(
                            'à', 'â', 'ä', 'á', 'ã', 'å',
                            'î', 'ï', 'ì', 'í', 
                            'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
                            'ù', 'û', 'ü', 'ú', 
                            'é', 'è', 'ê', 'ë', 
                            'ç', 'ÿ', 'ñ',
                            'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
                            'Î', 'Ï', 'Ì', 'Í', 
                            'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø', 
                            'Ù', 'Û', 'Ü', 'Ú', 
                            'É', 'È', 'Ê', 'Ë', 
                            'Ç', 'Ÿ', 'Ñ', '\''
                        ),
                        array(
                            'a', 'a', 'a', 'a', 'a', 'a', 
                            'i', 'i', 'i', 'i', 
                            'o', 'o', 'o', 'o', 'o', 'o', 
                            'u', 'u', 'u', 'u', 
                            'e', 'e', 'e', 'e', 
                            'c', 'y', 'n', 
                            'A', 'A', 'A', 'A', 'A', 'A', 
                            'I', 'I', 'I', 'I', 
                            'O', 'O', 'O', 'O', 'O', 'O', 
                            'U', 'U', 'U', 'U', 
                            'E', 'E', 'E', 'E', 
                            'C', 'Y', 'N', ''
                        ),$texte);
                    return $texte;
                }
            ?>  
        </div>

        <?php
            include 'creationBdd.php';
            $mysqli = mysqli_connect('127.0.0.1', 'root', '');
            $mysqli->query("USE Cocktails");
            if(isset($_POST['boutonAjouterPanier'])){
                $stmt = $mysqli->prepare("INSERT INTO Panier(loginP, nomCocktailsP, dateAjout) values (?,?,?)");
                $null = null;
                $stmt->bind_param("ssi", $compte, $_POST['nomCocktail'], $null);
                $stmt->execute();
                $stmt->close();
            }
            mysqli_close($mysqli);
        ?>

</body>
</html>