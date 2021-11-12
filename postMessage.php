<?php
    session_start();
    require('connectionBD.php');

    //Si l'utilisateur est connecté
    if(isset($_SESSION['login']))
    {
        try
        {
            $req = $req = $bdd->prepare("SELECT idU FROM users WHERE login = :login");
            $req->bindValue(':login', $_SESSION['login']);
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);

            if($res)
            {
                $idAuteur1 = $res['idU'];
            }

            $req->bindValue(':login', $_POST['submit']);
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);

            if($res)
            {
                $idAuteur2 = $res['idU'];
            }

            //sauvegarde le score dans la BD
            $req = $bdd->prepare("INSERT INTO messages(idAuteur1, idAuteur2, texteMessage, dateMessage) VALUES(:idAuteur1, :idAuteur2, :texteMessage, :dateMessage)");
            $req->bindValue(':idAuteur1', $idAuteur1);
            $req->bindValue(':idAuteur2', $idAuteur2);
            $req->bindValue(':texteMessage', $_POST['message']);
            $req->bindValue(':dateMessage', date('Y-m-d'));
            $req->execute();
            header('Location: messages.php?util='.$_POST['submit']);
            exit; // Ajout avec success        
        }
        catch(PDOException $e)
        {
            die('Erreur :'.$e -> getMessage());
        }
    }
    else
    {
        die("L'utilisateur n'est pas connecté");
    }
?>