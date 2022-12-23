<html>
    <head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="styleLogin.css" media="screen" type="text/css" />
    </head>

    <?php
        session_start();
        $valideMdp = false;
        $valideLogin = false;

        if (isset($_POST['username']) && isset($_POST['password'])){
            if (checkIdentification()){
                $_SESSION['login'] = $_POST['username'];
                header("Location: index.php");
                exit;
            } else {
                $valideMdp = true;
            }
        }

        function checkIdentification(){
            include 'creationBdd.php';
            $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

            $stmt = $sql->prepare("SELECT * FROM Utilisateur WHERE login = '".$_POST['username']."'");
            $stmt->execute();
            $login = $stmt->fetchAll();
            
            if (empty($login[0])) {
                global $valideLogin;
                $valideLogin = true;
            } else {
                if ($login[0]['mdp'] === $_POST['password']){
                    return true;
                }
            }

            return false;
        }
    ?>

    <body>
        <div id="container">
        
            <form action="#" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                <?php
                    if ($valideLogin) echo "<p style='color:red'>Aucun utilisateur trouvé</p>";
                ?>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                <?php
                    if ($valideMdp) echo "<p style='color:red'>Mot de passe incorrect</p>";
                ?>

                <input type="submit" id='submit' value='LOGIN' >

                <a href="index.php">Retour à l'accueil</a>
            </form>
        </div>

    </body>
</html>