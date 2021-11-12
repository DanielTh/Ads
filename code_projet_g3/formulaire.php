<?php
    require('connectionBD.php');

    if (isset($_POST['buttonVa'])){
        $login=$_POST['id'];
        $password=$_POST['pass'];
        $passVal=$_POST['passConfirm'];
        $email=$_POST['email'];
        $today = date("Y-m-d");
           
        // Verification si le login existe deja
        $req = $bdd->query('SELECT* FROM users');
        while($donnees = $req -> fetch()) {
            if($_POST['id']==$donnees['login']) {
                header('Location: inscription.php?inscriptionechouee=1'); // login deja existant
                exit;
            }
        }

        // Verification que le 1er password == au 2e password
        if($_POST['pass'] == $_POST['passConfirm']){ 
            $password = md5($_POST['pass']);
            $bdd->exec("INSERT INTO users(login,password,email,statut,dateInscription) VALUES('$login','$password','$email','user','$today')");
            header('Location: index.php');
            exit; // Ajout avec success
        }else{
            header('Location: inscription.php?inscriptionechouee=2'); // ECHEC Password different
            exit;
        }
    }
    header('Location: inscription.php?inscriptionechouee=3'); // Probleme pour entrer dans le IF*/
?>


