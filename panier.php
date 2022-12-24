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
    <link rel="stylesheet" href="stylePanier.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktails</title>
</head>
<body onload="reveal()">
    <div class="bandeau">

        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="index.php" class="logo">COCKTAILS</a>

        <div class="groupe-recherche">
            <input id="recherche" class="recherche" onkeyup="search()" type="search" onkeydown="applykeydown(event)" onkeyup="applykeyup(event)"
                name="recherche" placeholder="Rechercher dans le panier" autocomplete="off">

            <ul id="resultat" class="resultat" onclick="applyClick(event)" tabindex="0" onkeydown="applykeydown(event)" onkeyup="applykeyup(event)"></ul>
        </div> 

        <nav id="menu">
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
            </ul>
        </nav>
    </div>

    <div class="contenu">

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Builder.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Black_velvet.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Bloody_mary.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Bora_bora.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Caipirinha.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Coconut_kiss.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Margarita.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Tequila_sunrise.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item reveal">
            <img class="imgVignette" src="Photos/Tipunch.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

    </div>

    <script type="text/javascript" src="fonctionsPanier.js"></script>
</body>
</html>