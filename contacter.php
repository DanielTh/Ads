<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> Contacter </title>
    </head>
    <body>
        <?php
            include 'entete.php';

            if(!isset($_SESSION['login']))
            {
                header("Location:connection.php");
            }
        ?>
        <div class="container">
            <form class="form-signin" role="form" method="post" action="postMessage.php">
                <h2 class="form-signin-heading">Envoyer un message</h2> <br>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" rows="5" name="message" placeholder="Message"></textarea>
                </div>
                <br>
                <?php
                    echo '<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value='.$_GET['login'].'>Valider</button>';
                ?>
                <button class="btn btn-lg btn-primary btn-block" type="button"  onclick="window.location.href='index.php'">Annuler</button>
            </form>
            <br>
            <?php 
            if($_GET['inscriptionechouee'] == 1)
                echo '<div class="alert alert-danger"> <strong>Erreur inscription !</strong> Identifiant non disponible </div>';
            if($_GET['inscriptionechouee'] == 2) 
                echo '<div class="alert alert-danger"> <strong>Erreur inscription !</strong> Mot de passe non identique </div>';
            ?>
        </div>
    </body>
</html>