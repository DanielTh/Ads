<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Messages</title>
    </head>
    <body>
        <?php
            include 'entete.php';
        ?>

        <div class="container">
            <h1>Mes messages</h1>
            <?php
                require('connectionBD.php');

                try
                {
                    $users = array($_SESSION['login']);

                    $req = $bdd->prepare("SELECT u1.login, u2.login AS login2 FROM messages AS m LEFT JOIN users AS u1 ON m.idAuteur1 = u1.idU LEFT JOIN users AS u2 ON m.idAuteur2 = u2.idU WHERE u1.login = :login OR u2.login = :login");
                    $req->bindValue(":login", $_SESSION['login']);
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);



                    //Si la BD contient au moin 1 ligne
                    echo '<div class="row">';
                    if($res)
                    {                        
                            echo '<div class="col-md-4">';
                                echo '<div class="list-group">';
                                do{
                                    if(!in_array($res['login'], $users))
                                    {
                                        echo '<a href="messages.php?util='.$res['login'].'" class="list-group-item list-group-item-action">'.$res['login'].'</a>';
                                        array_push($users, $res['login']);
                                    }
                                    if(!in_array($res['login2'], $users))    
                                    {
                                        echo '<a href="messages.php?util='.$res['login2'].'" class="list-group-item list-group-item-action">'.$res['login2'].'</a>';
                                        array_push($users, $res['login2']);
                                    }                          
                                }while($res = $req->fetch(PDO::FETCH_ASSOC));
                                echo '</div>';
                            echo '</div>';
                    }


                    if(isset($_GET['util']) && $_GET['util'] != $_SESSION['login'])
                    {
                        $req = $bdd->prepare("SELECT u1.login, u2.login AS login2, texteMessage, idMessage FROM messages AS m LEFT JOIN users AS u1 ON m.idAuteur1 = u1.idU LEFT JOIN users AS u2 ON m.idAuteur2 = u2.idU WHERE (u1.login = :login AND u2.login = :login2) OR (u1.login = :login2 AND u2.login = :login)");
                        $req->bindValue(":login", $_SESSION['login']);
                        $req->bindValue(":login2", $_GET['util']);
                        $req->execute();
                        $res = $req->fetch(PDO::FETCH_ASSOC);
                        if($res){
                            echo '<div class="col-md-8" style="border-left:1px solid grey">';
                            echo '<div style="overflow-y: scroll; height:400px;">';
                            do
                            {
                                echo '<strong>'.$res['login'].' : </strong>';
                                echo '<p>'.$res['texteMessage'].'</p>';
                                echo '<hr>';

                            }while($res = $req->fetch(PDO::FETCH_ASSOC));
                        }
                        else
                        {
                            die("Aucun message");
                        }
                        echo <<<END
                            </div>
                                    <form class="form-signin" role="form" method="post" action="postMessage.php">
                                        <div class="form-group">
                                            <label for="message">Envoyer message</label>
                                            <textarea class="form-control" rows="3" name="message" placeholder="Message"></textarea>
                                        </div>
                                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value=$_GET[util]>Valider</button>
                                    </form>
                                </div>
                            </div>
END;
                    }
                    else
                    {
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
