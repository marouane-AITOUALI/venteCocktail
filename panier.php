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
    <div id="bandeau" class="bandeau">

        <img src="./Ressources/logo_cocktail.png" alt="" class="imgLogoCocktail">
            <a href="index.php" class="logo">COCKTAILS</a>

        <div class="groupe-recherche">
            <input id="recherche" class="recherche" onkeyup="search()" type="search" onkeydown="applykeydown(event)" onkeyup="applykeyup(event)"
                name="recherche" placeholder="Rechercher dans le panier" autocomplete="off">

            <ul id="resultat" class="resultat" onclick="applyClick(event)" tabindex="0" onkeydown="applykeydown(event)" onkeyup="applykeyup(event)"></ul>
        </div>
        
        <script>
            /*function search() {
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
            }*/
        </script>  

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

    <div id="contenu" class="contenu reveal">

        <?php
            include 'creationBdd.php';
            $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

            $stmt = $sql->prepare("SELECT * FROM Panier WHERE loginP = '" . $compte . "'");
            $stmt->execute();
            $res = $stmt->fetchAll();

            foreach($res as $array){
                $stmt = $sql->prepare("SELECT * FROM Cocktail WHERE nomCocktail = '" . $array['nomCocktailP'] . "'");
                $stmt->execute();
                $res = $stmt->fetchAll();
                foreach($res as $cocktail){
                    $photo = "Photos/defaut";//Photo de base
                    $string = str_replace(" ", "_", stripAccents($cocktail['nomCocktail']));
                    if (file_exists("Photos/". $string . ".jpg")){
                        $photo = "Photos/" . $string . ".jpg";
                    }

                    echo "
                    <div class='grid-item reveal'>
                        <img class='imgVignette' src='$photo'  alt=''>
                        <div class='text'>" .
                            $cocktail['nomCocktail'] . "";

                            foreach(explode('|', $cocktail['nomAlimentsC']) as $aliment){
                                echo "
                                    <li>$aliment</li>
                                ";
                            }
                        
                        $str = $cocktail['nomCocktail'];
                        echo "</div>
                        <a id='boutonRetirer' name='$str' href='#' onClick='removeItem(this)' class='boutonRetirer'>Retirer</a>
                    </div>
                    ";
                }
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

    <script type="text/javascript" src="fonctionsPanier.js"></script>
</body>
</html>