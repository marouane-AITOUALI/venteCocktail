<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="stylePanier.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktails</title>
</head>
<body>
    <div class="header">
        <nav id="bandeau">
        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="index.php" class="logo">COCKTAILS</a>

            <input id="recherche" class="recherche" onkeyup="" type="text"
                name="recherche" placeholder="Rechercher dans le site">

                <ul id="navigation" class="navigation">
                    <li>
                        <a href="#" id="boutonCocktails">Aliment ▼</a>
                        <ul class="sous-menu">
                            <li><a href="#">Fruit</a></li>
                            <li><a href="#">Assaisonnement</a></li>
                            <li><a href="#">Liquide</a></li>
                            <li><a href="#">Noix et graine</a></li>
                            <li><a href="#">Oeuf</a></li>
                            <li><a href="#">Aliments divers</a></li>
                            <li><a href="#">Produit laitier</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="boutonCompte">Compte
                            <img src="./Ressources/logo_compte.png" alt="" class="imgLogoCompte">
                        </a>
                        <ul class="sous-menu">
                            <li><a href="#">Se connecter</a></li>
                        </ul>
                    </li>
                    <li><a href="#" id="boutonPanier">Panier
                        <img src="./Ressources/logo_like.png" alt="" class="imgLogoLike">
                    </a></li>
                </ul>
        </nav>
    </div>

    <div class="contenu">

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Builder.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Black_velvet.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Bloody_mary.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Bora_bora.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Caipirinha.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Coconut_kiss.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Margarita.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
            <img class="imgVignette" src="Photos/Tequila_sunrise.jpg"  alt="">
            <div class="text">
                Cocktail Builder
                <li>Biere</li>
                <li>Champagne</li>
            </div>
            <a href="" class="boutonRetirer">Retirer</a>
        </div>

        <div class="grid-item">
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