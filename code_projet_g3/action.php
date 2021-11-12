<?php

 require('connectionBD.php');

    if(isset($_POST['buttonCo'])) {
        $req = $bdd->query('SELECT * FROM users');
        while($donnees = $req -> fetch()) {
            if($_POST['id']==$donnees['login'] && md5($_POST['pass'])==$donnees['password']) {
                session_start();
                $_SESSION['login'] = $_POST['id'];
                $_SESSION['statut'] = $donnees['statut'];
                header('Location: index.php');
                exit;
            }
        }
        header('Location: connection.php?connexionechouee=1');
    }
?>