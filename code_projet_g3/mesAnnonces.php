<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mes annonces</title>
        <style>
            .annonce:hover
            {
                background-color : #efefef;
                cursor : pointer;
            }
            img
            {
                padding : 1em;
            }
        </style>
    </head>
    <body>
        <?php
            include 'entete.php';
        ?>
        <h1 style = "text-align : center" > Annonces </h1>

        <div class="container">
            <?php
                if($_GET['suppression'] == 1)
                    echo '<div class="alert alert-danger text-center"> <strong>Annonce suprimée</strong></div>';
                if($_GET['suppression'] == 2) 
                    echo '<div class="alert alert-danger text-center"> <strong>Erreur suprression</strong></div>';
                require('connectionBD.php');    

                try
                {
                    $resultats_par_page = 4;
                    if(isset($_GET["page"])) 
                    { 
                        $page  = $_GET["page"]; 
                    } 
                    else 
                    { 
                        $page=1; 
                    }
                    //Recherche noms des quiz
                    $commencer_par = ($page-1) * $resultats_par_page;
                    $req = $bdd->prepare("SELECT * FROM annonces INNER JOIN users ON annonces.idAuteur = users.idU WHERE login = :login ORDER BY idAnnonce DESC LIMIT $commencer_par, $resultats_par_page");
                    $req->bindValue(":login", $_SESSION['login']);
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);

                    //Si la BD contient au moin 1 ligne
                    if($res){
                        $id = $res['idU'];
                        do{
                            echo    '<div class="row annonce">';
                            echo        '<div class="col-lg-3">';
                            echo            '<a href="annonce.php?id='.$res['idAnnonce'].'"></a>';
                            echo            '<img src="http://pingendo.github.io/pingendo-bootstrap/assets/placeholder.png" class="img-responsive">';
                            echo        '</div>';
                            echo        '<div class="col-lg-9">';
                            echo            '<h3>'.$res['titreAnnonce'].'</h3>';
                            echo            '<h5>par '.$res['login'].'</h5>';
                            echo            '<p>'.$res['texteAnnonce'].'</p>';
                            echo            '<h4>'.$res['dateAnnonce'].'</h4>';
                            echo        '<form action="supprimer.php" method="post">';
                            echo        '<button type="submit" class="btn btn-danger" data-id="'.$res['idAnnonce'].'" name="id" value="'.$res['idAnnonce'].'">Supprimer</button>';
                            echo        '</form>';
                            echo        '</div>';
                            echo    '</div>';
                        }while($res = $req->fetch(PDO::FETCH_ASSOC));
                    }
                    else
                    {
                        die("Aucune annonce dans la BD");
                    }

                    $req = $bdd->prepare("SELECT COUNT(*) AS nb_annonces FROM annonces WHERE idAuteur = :idAuteur");
                    $req->bindValue(":idAuteur", $id);
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);
                    $nb_pages = ceil($res['nb_annonces']/$resultats_par_page);

                    echo '<div class="row text-center">';
                    echo '<ul class="pagination" id="page">';
                    for($i = 1; $i <= $nb_pages; $i++)
                    {
                        if($i != $page)
                        {
                            echo '<li><a href="mesAnnonces.php?page='.$i.'">'.$i.'</a></li>';                                
                        }
                        else
                        {
                            echo '<li class="active"><a>'.$i.'</a></li>';
                        }                            
                    }                        
                    echo '</ul>';
                    echo '</div>';
                }
                catch(PDOException $e)
                {
                    die('Erreur : ' . $e->getMessage());
                }
            ?>
            
        </div>
    </body>
    <script>
        $(document).ready(function(){

            $(".annonce").click(function() {
                window.location = $(this).find("a").attr("href"); 
                return false;
            });
            $("button").click(function(e) {
                var id = $(this).data("id");
                //window.location.href = "supprimer.php?id=" + id; 
                e.stopPropagation();
            });
        });
    </script>
</html>
