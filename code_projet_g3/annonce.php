<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Annonce</title>
    </head>
    <body>
        <?php
            include 'entete.php';
        ?>

        <div class="container">
            <?php
                require('connectionBD.php');    

                try
                {
                    $req = $bdd->prepare("SELECT * FROM annonces INNER JOIN users ON annonces.idAuteur = users.idU WHERE idAnnonce = :idAnnonce");
                    $req->bindValue("idAnnonce", $_GET['id']);
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);

                    //Si la BD contient au moin 1 ligne
                    if($res){
                        echo <<<END
                        <div class="row">
                            <div class="col-md-9">
                                <img src="http://pingendo.github.io/pingendo-bootstrap/assets/placeholder.png"class="img-responsive">
                                <h1>$res[titreAnnonce]</h1>
                                <h4>Le $res[dateAnnonce]</h4>
                                <p>$res[texteAnnonce]</p>
                            </div>
                            <div class="col-md-3">
                                <img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png"
                                class="center-block img-circle img-responsive">
                                <h3 class="text-center">$res[login]</h3>
                                <h4 class="text-center">email : $res[email]</h4>
                                <div class="text-center"><a href="contacter.php?login=$res[login]" class="btn btn-primary">Contacter</a></div>
                            </div>
                        </div>
END;
                    }
                    else
                    {
                        die("Aucune annonce dans la BD");
                    }
                }
                catch(PDOException $e)
                {
                    die('Erreur : ' . $e->getMessage());
                }
            ?>
            
        </div>
    </body>
</html>
