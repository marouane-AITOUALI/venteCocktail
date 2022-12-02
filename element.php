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
    <div class="header">
        <nav id="bandeau">
        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="#" class="logo">COCKTAILS</a>

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
        <img class="image" src="Photos/Builder.jpg"  alt="">
        <div class="texte">
            <h1>Ingredients</h1>
            <li>1 concombre</li>
            <li>1 citron</li>
            <li>1 cuillère à soupe de sucre</li>
            <li>3 glaçons</li><br>
            <h1>Preparation</h1>
            <li>Mixer le concombre dans la centrifugeuse, ajouter le jus du citron, le sucre et les glaçons. Servir dans un verre décoré d'une tranche de citron.</li>
        </div>
    </div>

    <script type="text/javascript" src="fonctionsCocktails.js"></script>
</body>
</html>