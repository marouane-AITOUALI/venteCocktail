<?php
    /*if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])){
    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
    }*/
    if (isset($_POST['username']) && isset($_POST['password'])){
        /*if (checkIdentification()){
            exec("index.php");
        }*/
        checkIdentification();
    }

    function checkIdentification(){
        include 'creationBdd.php';
        $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

        $stmt = $sql->prepare("SELECT * FROM Utilisateur WHERE login = '".$_POST['username']."'");
        $stmt->execute();
        $login = $stmt->fetchAll();
        
        //print_r($login);
        /*echo "Login : ", $login[0]['login'], "<br>";
        echo "Mdp : ", $login[0]['mdp'];*/
        if (empty($login[0])) {
            echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
        } else {
            if ($login[0]['mdp'] === $_POST['password']){
                echo "Login : ", $login[0]['login'], "   ", $_POST['username'], "<br>";
                echo "Mdp : ", $login[0]['mdp'] , "   ", $_POST['password'];
                return true;
            } else {
                echo "<p style='color:red'>Mot de passe incorrect</p>";
            }
        }

        return false;
    }
?>