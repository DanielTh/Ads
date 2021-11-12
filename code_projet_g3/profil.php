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
                    $req = $bdd->prepare("SELECT * FROM users WHERE login = :login");
                    $req->bindValue(":login", $_SESSION['login']);
                    $req->execute();
                    $res = $req->fetch(PDO::FETCH_ASSOC);

                    //Si la BD contient au moin 1 ligne
                    if($res){
                        echo <<<END
                        <div class="container">
                        	<h1>Profil</h1>
	                        <div class="row">
		                        <div class="col-md-12">
		                        	<table class="table">
			                        	<thead>
				                        	<tr>
				                        		<th>Login</th>
				                        		<th>Email</th>
				                        		<th>Date d'inscription</th>
				                        	</tr>
			                        	</thead>
			                        	<tbody>
				                        	<tr>
				                        		<td>$res[login]</td>
				                        		<td>$res[email]</td>
				                        		<td>$res[dateInscription]</td>
				                        	</tr>
			                        	</tbody>
		                        	</table>
		                        </div>
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