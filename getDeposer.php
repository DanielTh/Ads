<?php
    session_start();
    require('connectionBD.php');

    //Si l'utilisateur est connecté
    if(isset($_SESSION['login']))
    {
        try
        {
            if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"]))
            {
                $target_dir = "images_annonces/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["buttonVa"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        echo "Le fichier est une image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "Le fichier n'est pas une image.";
                        $uploadOk = 0;
                    }
                }
                // Check si le fichier existe déjà
                if (file_exists($target_file)) {
                    echo "Le fichier existe déjà";
                    $uploadOk = 0;
                }
                // Check la taille du fichier
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Le fichier est trop volumineux";
                    $uploadOk = 0;
                }
                // Check si le fichier est une image
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Le fichier doit être une image";
                    $uploadOk = 0;
                }
                // Check si il y a une image
                if ($uploadOk == 0) {
                    echo "Le fichier n'a pas été sauvegardé";
                // Si tout test ok, sauvegarder le fichier
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été sauvegardé";
                    } else {
                        echo "Erreur lors de la sauvegarde du fichier";
                    }
                }
            }

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
            $req = $bdd->prepare("INSERT INTO annonces(idAuteur, titreAnnonce, texteAnnonce, imageAnnonce, dateAnnonce) VALUES(:idAuteur, :titreAnnonce, :texteAnnonce, :imageAnnonce, :dateAnnonce)");
            $req->bindValue(':idAuteur', $idAuteur);
            $req->bindValue(':titreAnnonce', $_POST['titre']);
            $req->bindValue(':texteAnnonce', $_POST['description']);
            $req->bindValue(':imageAnnonce', basename($_FILES["fileToUpload"]["name"]));
            $req->bindValue(':dateAnnonce', date('Y-m-d'));
            $req->execute();            

            header('Location: mesAnnonces.php');
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