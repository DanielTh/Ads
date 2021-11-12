<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Annonces</title>
        <style>
            .image
            {
                height: 200px;
            }
            .annonce:hover
            {
                background-color : #efefef;
                cursor : pointer;
            }
            img
            {
                padding : 1em;
                max-height: 100%;
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
                    
                    $commencer_par = ($page-1) * $resultats_par_page;
                    $req = $bdd->prepare("SELECT * FROM annonces INNER JOIN users ON annonces.idAuteur = users.idU ORDER BY idAnnonce DESC LIMIT $commencer_par, $resultats_par_page");         
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);

                    //Si la BD contient au moin 1 ligne
                    if($res){
                        do{
                            echo    '<div class="row annonce">';
                            echo        '<div class="col-lg-3 image">';
                            echo            '<a href="annonce.php?id='.$res['idAnnonce'].'"></a>';
                            echo            '<img src="images_annonces/'.$res['imageAnnonce'].'" class="img-responsive" onerror="this.src=\'http://pingendo.github.io/pingendo-bootstrap/assets/placeholder.png\';">';
                            echo        '</div>';
                            echo        '<div class="col-lg-9">';
                            echo            '<h3>'.$res['titreAnnonce'].'</h3>';
                            echo            '<h5>par '.$res['login'].'</h5>';
                            echo            '<p>'.$res['texteAnnonce'].'</p>';
                            echo            '<h4>'.$res['dateAnnonce'].'</h4>';
                            echo        '</div>';
                            echo    '</div>';
                        }while($res = $req->fetch(PDO::FETCH_ASSOC));
                    }
                    else
                    {
                        die("Aucune annonce dans la BD");
                    }

                    $req = $bdd->prepare("SELECT COUNT(*) AS nb_annonces FROM annonces");
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);
                    $nb_pages = ceil($res['nb_annonces']/$resultats_par_page);

                    echo '<div class="row text-center">';
                    echo '<ul class="pagination" id="page">';
                    for($i = 1; $i <= $nb_pages; $i++)
                    {
                        if($i != $page)
                        {
                            echo '<li><a href="annonces.php?page='.$i.'">'.$i.'</a></li>';                                
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
                e.stopPropagation();
            });

        });
    </script>
</html>
