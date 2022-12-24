<?php
            $alimentMenu = "";
            if (isset($_POST['recherche'])){
                $alimentMenu = $_POST['recherche'];
            }

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