<?php
    include 'creationBdd.php';
    $sql = new PDO("mysql:host=127.0.0.1;dbname=Cocktails","root","");

    if ($_POST['recherche'] != ""){
        $stmt = $sql->prepare("SELECT * FROM Cocktail");
        $stmt->execute();
        $res = $stmt->fetchAll();

        if (empty($res)){
            echo "<li>Aucun résultat</li>";
        }

        foreach($res as $tmp => $cocktail){
            foreach(explode('|', $cocktail['nomAlimentsC']) as $aliment){
                if (preg_match('/' . $_POST['recherche'] . '/i', $aliment)) { //Regex pour voir si $aliment contient $_POST['recherche']
                    echo "<li>" . $aliment . "</li>";
                }
            }
        }
    }
?>