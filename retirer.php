<?php
    session_start();

    //Suppression dans la table Panier
    include 'creationBdd.php';
    $mysqli = mysqli_connect('127.0.0.1', 'root', '', 'Cocktails');
    if (isset($_SESSION['login'])){
        $mysqli->query("DELETE FROM Panier WHERE loginP = '" . $_SESSION['login'] . "' AND nomCocktailP = '" . $_POST['cocktail'] . "'");
    } else {
        $mysqli->query("DELETE FROM Panier WHERE loginP = 'Compte' AND nomCocktailP = '" . $_POST['cocktail'] . "'");
    }
    mysqli_close($mysqli);


    //Actualisation de l'affichage
    $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");
    $stmt = $sql->prepare("SELECT * FROM Panier WHERE loginP = '" . $_SESSION['login'] . "'");
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
                '??', '??', '??', '??', '??', '??',
                '??', '??', '??', '??', 
                '??', '??', '??', '??', '??', '??', 
                '??', '??', '??', '??', 
                '??', '??', '??', '??', 
                '??', '??', '??',
                '??', '??', '??', '??', '??', '??',
                '??', '??', '??', '??', 
                '??', '??', '??', '??', '??', '??', 
                '??', '??', '??', '??', 
                '??', '??', '??', '??', 
                '??', '??', '??', '\''
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