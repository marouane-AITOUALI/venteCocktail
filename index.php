<?php
    session_start();
    $compte = "Compte";
    if (isset($_SESSION['login'])){
        $compte = $_SESSION['login'];
    }

    $alimentMenu = "";
    if (isset($_GET['aliment'])){
        $alimentMenu = $_GET['aliment'];
    }

    if (isset($_GET['recherche'])){
        $alimentMenu = $_GET['recherche'];
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

<body onload="reveal()" onclick="loseFocus()">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div id="bandeau" class="bandeau">
        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="index.php" class="logo">COCKTAILS</a>

        <div class="groupe-recherche">
            <input id="recherche" class="recherche" onkeyup="search()" type="search" onkeydown="applykeydown(event)" onkeyup="applykeyup(event)"
                name="recherche" placeholder="Rechercher dans le site" autocomplete="off">

            <ul id="resultat" class="resultat" onclick="applyClick(event)" tabindex="0" onkeydown="applykeydown(event)" onkeyup="applykeyup(event)"></ul>
        </div>    

        <script>
            function search() {
                //Ajax
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //Mise à jour des résultats            
                        document.getElementById("resultat").innerHTML = supprimerDoublons(this.responseText);

                        if (this.responseText != ""){
                            document.getElementById("resultat").style.display = "block";
                        }
                    }
                };
                xhttp.open("POST", "recherche.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("recherche=" + document.getElementById("recherche").value);
            }

            function supprimerDoublons(contenu){
                var liElements = contenu.split("</li>"); //Diviser la chaîne en un tableau encadrées par <li> et </li>

                var sansDoublons = liElements.filter(function(liElement, index, self) { //Suppression des doublons
                    return index === self.indexOf(liElement);
                });

                var resultat = sansDoublons.join("</li>"); //Reassembler la chaine

                //console.log("Res : " + resultat);
                return resultat;
            }

            function applyClick(event){
                var lis = document.getElementById('resultat').getElementsByTagName('li');
                loseFocus();
                refreshPage(lis[selectedIndex].textContent);
            }

            var selectedIndex = -1; // Index de l'option sélectionnée -1 si aucun

            function applykeydown(event) {

                // Sélection de l'élément suivant avec la flèche du haut
                if (event.keyCode == 38) {
                    resultat.focus();
                    if (selectedIndex > 0) {
                        selectedIndex--;
                    }
                }
                // Sélection de l'élément précédent avec la flèche du bas
                else if (event.keyCode == 40) {
                    resultat.focus();
                    if (selectedIndex < document.getElementById('resultat').getElementsByTagName('li').length - 1) {
                        selectedIndex++;
                    }
                }
            }

            function applykeyup(event) {
                var lis = document.getElementById('resultat').getElementsByTagName('li');

                // Validation de la sélection avec la touche Entrée
                if (event.keyCode == 13) {
                    recherche.focus();
                    if (selectedIndex >= 0) {
                        //Actualisation de la page
                        loseFocus();
                        refreshPage(lis[selectedIndex].textContent);
                    }
                }

                // Sélection de l'élément cliqué
                for (var i = 0; i < document.getElementById('resultat').getElementsByTagName('li').length; i++){
                    lis[i].style.backgroundColor = "white";
                    lis[i].style.color = "black";
                    if (i == selectedIndex){
                        lis[selectedIndex].style.backgroundColor = "#494ee8";
                        lis[selectedIndex].style.color = "white";
                    }
                }
            }

            function loseFocus(){
                document.getElementById("resultat").style.display = "none";
            }

            function refreshPage(value) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Mise à jour de la page avec les données reçues
                        document.getElementById("recherche").value = "";
                        document.getElementById("contenu").innerHTML = this.responseText;
                        reveal();
                    }
                };
                xhttp.open("POST", "refresh.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("recherche=" + value);
            }
        </script>   

        <?php
            include 'creationBdd.php';
            $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

            // Query the database to retrieve the menu and submenu items
            $stmt = $sql->prepare("SELECT * FROM Aliment");
            $stmt->execute();
            $menu = $stmt->fetchAll();


            // Output the menu and submenus as an HTML list
            echo "<nav id='menu'>";
                echo "<ul>";
                    echo "<li><a href='#'>Aliment ▼</a><ul>";
                    foreach ($menu as $menuItem) {
                        //echo "Item : ", $menuItem['nomAliment'], "<br>";
                        if ($menuItem['pereAliment'] === "Aliment"){ //On affiche le premier menu
                            echo "<li><a href='index.php?aliment=" . $menuItem['nomAliment'] . "'>◀ " . $menuItem['nomAliment'] . "</a>";
                            // Query the database to retrieve the submenu items for the current menu item
                            $stmt = $sql->prepare("SELECT * FROM Aliment WHERE pereAliment = ?");
                            $stmt->execute([$menuItem['nomAliment']]);
                            $subMenu = $stmt->fetchAll();
                            // Output the submenu as an HTML list
                            if (!empty($subMenu)) {
                                echo "<ul>";
                                foreach ($subMenu as $subMenuItem) {
                                    echo "<li><a href='index.php?aliment=" . $subMenuItem['nomAliment'] . "'>" . $subMenuItem['nomAliment'] . "</a>";
                                    echo "<ul>";

                                    $stmt = $sql->prepare("SELECT * FROM Aliment WHERE pereAliment = ?"); //Sous menu 1
                                    $stmt->execute([$subMenuItem['nomAliment']]);
                                    $sub2Menu = $stmt->fetchAll();

                                    if (!empty($sub2Menu)) {
                                        foreach ($sub2Menu as $sub2MenuItem) {
                                            if ($sub2MenuItem['pereAliment'] === $subMenuItem['nomAliment']){
                                                echo "<li><a href='index.php?aliment=" . $sub2MenuItem['nomAliment'] . "'>" . $sub2MenuItem['nomAliment'] . "</a></li>";
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
                <ul>";

                if (!isset($_SESSION['login'])){
                    echo "<li><a href='login.php'>Se connecter</a></li>";
                } else {
                    echo "<li><a href='logout.php'>Se déconnecter</a></li>";
                }
                
                echo "
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
        ?>  

    </div>

    <div id="contenu" class="contenu">  

        <?php
            //Affichage des cocktails à partir de la base de données
            include 'creationBdd.php';
            $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

            $stmt = $sql->prepare("SELECT * FROM Cocktail WHERE nomAlimentsC LIKE '%" . $alimentMenu . "%'"); //Gerer les menu -> contient tel aliment ---A REVOIR---
            $stmt->execute();
            $res = $stmt->fetchAll();

            foreach($res as $tmp => $cocktail){
                $photo = "Photos/defaut";//mettre un _ pour certains noms
                $string = str_replace(" ", "_", stripAccents($cocktail['nomCocktail']));
                if (file_exists("Photos/". $string . ".jpg")){
                    $photo = "Photos/" . $string . ".jpg";
                }
                echo "
                    <div class='grid-item1 reveal'>
                    <a class='a-img-txt' href='element.php?cocktail=" . $cocktail['nomCocktail'] . "'>
                        <img class='imgVignette' src='$photo'  alt='En savoir plus'>
                        <span class='a-txt'>En savoir plus</span>
                    </a>
                    <div class='text'><h2>".
                    $cocktail['nomCocktail']
                    ."</h2>";
                        foreach(explode('|', $cocktail['nomAlimentsC']) as $aliment){
                            echo "
                                <li>$aliment</li>
                            ";
                        }
                echo "        
                    </div>
                </div>  
                ";
            }

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

    <script type="text/javascript" src="fonctionsCocktails.js"></script>
</body>
</html>