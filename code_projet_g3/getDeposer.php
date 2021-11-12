<?php
    session_start();
    require('connectionBD.php');

    //Si l'utilisateur est connecté
    if(isset($_SESSION['login']))
    {
        try
        {
                $req = $req = $bdd->prepare("SELECT * FROM users WHERE login = :login");
                $req->bindValue(':login', $_SESSION['login']);
                $req->execute();
                $res = $req->fetch(PDO::FETCH_ASSOC);

                $idAuteur;
                if($res)
                {
                    $idAuteur = $res['idU'];
                }

                //sauvegarde de l'annonce dans la BD
                $req = $bdd->prepare("INSERT INTO annonces(idAuteur, titreAnnonce, texteAnnonce, dateAnnonce) VALUES(:idAuteur, :titreAnnonce, :texteAnnonce, :dateAnnonce)");
                $req->bindValue(':idAuteur', $idAuteur);
                $req->bindValue(':titreAnnonce', $_POST['titre']);
                $req->bindValue(':texteAnnonce', $_POST['description']);
                $req->bindValue(':dateAnnonce', date('Y-m-d'));
                $req->execute();
                header('Location: annonces.php');
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