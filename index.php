<?php
    session_start();
    $compte = "Compte";
    if (isset($_SESSION['login'])){
        $compte = $_SESSION['login'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styleCocktails.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktails</title>
</head>

<body onload="reveal()">
    <div id="bandeau" class="bandeau">
        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="#" class="logo">COCKTAILS</a>

        <input id="recherche" class="recherche" onkeyup="" type="text"
            name="recherche" placeholder="Rechercher dans le site">

        <?php
            include 'creationBdd.php';
            $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

            // Query the database to retrieve the menu and submenu items
            $stmt = $sql->prepare("SELECT * FROM Aliment");
            $stmt->execute();
            $menu = $stmt->fetchAll();


            // Output the menu and submenus as an HTML list
            echo "<nav>";
                echo "<ul>";
                    echo "<li><a href='#'>Aliment ▼</a><ul>";
                    foreach ($menu as $menuItem) {
                        //echo "Item : ", $menuItem['nomAliment'], "<br>";
                        if ($menuItem['pereAliment'] === "Aliment"){ //On affiche le premier menu
                            echo "<li><a href='#'>◀ " . $menuItem['nomAliment'] . "</a>";
                            // Query the database to retrieve the submenu items for the current menu item
                            $stmt = $sql->prepare("SELECT * FROM Aliment WHERE pereAliment = ?");
                            $stmt->execute([$menuItem['nomAliment']]);
                            $subMenu = $stmt->fetchAll();
                            // Output the submenu as an HTML list
                            if (!empty($subMenu)) {
                                echo "<ul>";
                                foreach ($subMenu as $subMenuItem) {
                                    echo "<li><a href='#'>" . $subMenuItem['nomAliment'] . "</a>";
                                    echo "<ul>";

                                    $stmt = $sql->prepare("SELECT * FROM Aliment WHERE pereAliment = ?"); //Sous menu 1
                                    $stmt->execute([$subMenuItem['nomAliment']]);
                                    $sub2Menu = $stmt->fetchAll();

                                    if (!empty($sub2Menu)) {
                                        foreach ($sub2Menu as $sub2MenuItem) {
                                            if ($sub2MenuItem['pereAliment'] === $subMenuItem['nomAliment']){
                                                echo "<li><a href='#'>" . $sub2MenuItem['nomAliment'] . "</a></li>";
                                            }
                                        }
                                    }
                                    echo "</li></ul>";
                                }
                                echo "</ul>";
                            }
                            echo "</li>";
                        }
                    }
                echo "</ul></li>";

                echo "
                <li>
                    <a href='#' id='boutonCompte'>$compte
                    <img src='./Ressources/logo_compte.png' alt='' class='imgLogoCompte'>
                    </a>
                <ul>
                <li><a href='login.php'>Se connecter</a></li>
                <li><a href='#' onclick='session_unset(); session_destroy();'>Se déconnecter</a></li>
                </li>
                </ul>
                </li><!--
                --><li>
                    <a href='panier.php' id='boutonPanier'>Panier
                    <img src='./Ressources/logo_like.png' alt='' class='imgLogoLike'>
                    </a>
                </li>
                ";

                echo "</ul>";
            echo "</nav>";

            /*function deconnect(){
                echo "<br><br><br><br><br><p>qepspioqhjsgihjqqziogjhzegjozeiorpgjpozeijgpoizjgopegjoprgjproegjergj</p>";
                if (isset($_SESSION['login'])){
                    echo "testsgb";
                    session_unset();
                    session_destroy();
                    header("Location: index.php");
                    exit;
                }
                return false;
            }*/

        //$sql->close();
        ?>  

    </div>

    <div class="contenu">  

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Builder.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Black_velvet.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Black Velvet
                <li>Fraise</li>
                <li>Limonade</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Bora_bora.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Bora Bora
                <li>Biere</li>
                <li>Test</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Bloody_mary.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Bloody mary
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Coconut_kiss.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Coconut kiss
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Caipirinha.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Caipirinha
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Mojito.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Mojito
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Cuba_libre.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Cuba libre
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Le_vandetta.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Le vandetta
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Frosty_lime.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Frosty lime
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Sangria_sans_alcool.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Sangria sans alcool
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Screwdriver.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Screwdriver
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Shoot_up.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Shoot up
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Raifortissimo.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Raifortissimo
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Tipunch.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Tipunch
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Builder.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Black_velvet.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Black Velvet
                <li>Fraise</li>
                <li>Limonade</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Bora_bora.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Bora Bora
                <li>Biere</li>
                <li>Test</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Bloody_mary.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Bloody mary
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Coconut_kiss.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Coconut kiss
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Caipirinha.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Caipirinha
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Mojito.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Mojito
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Cuba_libre.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Cuba libre
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Le_vandetta.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Le vandetta
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Frosty_lime.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Frosty lime
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Sangria_sans_alcool.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Sangria sans alcool
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Screwdriver.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Screwdriver
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Shoot_up.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Shoot up
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Raifortissimo.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Raifortissimo
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

        <div class="grid-item1 reveal">
            <a class="a-img-txt" href="element.php">
                <img class="imgVignette" src="Photos/Tipunch.jpg"  alt="En savoir plus">
                <span class="a-txt">En savoir plus</span>
            </a>
            <div class="text">
                Cocktail Tipunch
                <li>Biere</li>
                <li>Champagne</li>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="fonctionsCocktails.js"></script>
</body>
</html>