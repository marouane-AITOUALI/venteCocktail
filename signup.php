<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleSignUp.css" media="screen" type="text/css" />
    <title>Sign Up</title>
</head>

<?php
        $valideLogin = false;
        $valideMdp = false;
        $valideNom = false;
        $validePrenom = false;
        $valideSexe = false;
        $valideMail = false;

        if (isset($_POST['username']) && !loginExist()){
            $valideLogin = true;
        }

        if (isset($_POST['password']) && strlen($_POST['password']) > 6){
            $valideMdp = true;
        }

        if (isset($_POST['name']) && strlen($_POST['name']) > 2){
            $valideNom = true;
        }

        if (isset($_POST['prenom']) && strlen($_POST['prenom']) > 2){
            $validePrenom = true;
        }

        if (isset($_POST['sexe'])){
            $valideSexe = true;
        }

        /*if (isset($_POST['mail'])){
            if (preg_match($_POST['mail'], '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/')){
                $valideMail = true;
            }
        }*/

        function loginExist(){
            include 'creationBdd.php';
            $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

            $stmt = $sql->prepare("SELECT * FROM Utilisateur WHERE login = '".$_POST['username']."'");
            $stmt->execute();
            $login = $stmt->fetchAll();
            
            if (empty($login[0])) {
                return false;
            }

            return true;
        }

        if ($valideLogin && $valideMdp){
            include 'creationBdd.php';
            $mysqli = mysqli_connect('127.0.0.1', 'root', '');
            $mysqli->query("USE Cocktails");
            if(isset($_POST['creer'])){
                $stmt = $mysqli->prepare("INSERT INTO Utilisateur(login, mdp, nom, prenom, sexe, numTel, dateNaissance, mail, adresse, codePostal, ville) values (?,?,?,?,?,?,?,?,?,?,?)");                
                $stmt->bind_param("ssssssissss", $_POST['username'], $_POST['password'], $_POST['name'], $_POST['prenom'], $_POST['sexe'], $_POST['telephone'], $_POST['naissance'], $_POST['mail'], $_POST['adresse'], $_POST['codePostal'], $_POST['ville']);
                if (!$stmt->execute()) {
                    echo "Error: " . mysqli_error($mysqli);
                }
                $stmt->close();
                header("Location: login.php");
                exit();
            }
            mysqli_close($mysqli);
        }
        ?>

<body>
    <div id="container">
        
        <form action="#" method="POST">
            <h1>Création compte</h1>
            
            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Nom d'utilisateur incorrect</p>";
            ?>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Mot de passe incorrect</p>";
            ?>

            <label><b>Nom</b></label>
            <input type="text" placeholder="Entrer un nom" name="name" required>
            <?php
                if (!$valideNom && isset($_POST['submit'])) echo "<p style='color:red'>Nom invalide</p>";
            ?>

            <label><b>Prénom</b></label>
            <input type="text" placeholder="Entrer un prénom" name="prenom" required>
            <?php
                if (!$validePrenom && isset($_POST['submit'])) echo "<p style='color:red'>Prenom invalide</p>";
            ?>

            <label><b>Sexe</b></label>
            <span>
                <input type="radio" name="sexe" value="h"/>Homme
                <input type="radio" name="sexe" value="f"/>Femme
            </span>
            <?php
                if (!$valideSexe && isset($_POST['submit'])) echo "<p style='color:red'>Aucun sexe selectionné</p>";
            ?>
            <br><br><br><br><br>

            <label><b>Numéro de téléphone</b></label>
            <input type="text" placeholder="Entrer un numéro de téléphone" name="telephone" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
            ?>

            <label><b>Date de naissance</b></label>
            <input type="date" placeholder="Entrer une date de naissance" name="naissance" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
            ?>

            <label><b>E-Mail</b></label>
            <input type="text" placeholder="Entrer une adresse e-mail" name="mail" required>
            <?php
                if (!$valideMail && isset($_POST['submit'])) echo "<p style='color:red'>E-Mail non conforme</p>";
            ?>

            <label><b>Rue</b></label>
            <input type="text" placeholder="Entrer une adresse, n° de rue + rue" name="adresse" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
            ?>

            <label><b>Code postal</b></label>
            <input type="text" placeholder="Entrer un code postal" name="codePostal" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
            ?>

            <label><b>Ville</b></label>
            <input type="text" placeholder="Entrer une ville" name="ville" required>
            <?php
                if (!$valideLogin && isset($_POST['submit'])) echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
            ?>

            <input name="creer" type="submit" id='submit' value='SIGN UP' >

            <a href="index.php">Retour à l'accueil</a>
            <a class="lien" href="login.php">Se connecter</a>
        </form>
    </div>

</body>
</html>