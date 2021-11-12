<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> Deposition d'annonce </title>
    </head>
    <body>
        <?php
            include 'entete.php';
        ?>
        <div class="container">
            <form class="form-signin" role="form" method="post" action="getDeposer.php">
                <h2 class="form-signin-heading">Déposer une annonce</h2> <br>
                <div class="input-group">
                    <label for="usr">Titre de l'annonce</label>
                    <input type="text" class="form-control" placeholder="Titre" name="titre" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label for="description">Description de l'annonce</label>
                    <textarea class="form-control" rows="5" name="description" placeholder="Description"></textarea>
                </div>
                <br>
                <!--
                <form id="uploadbanner" enctype="multipart/form-data" method="post" action="#">
                    <label for="myfile">Image</label>
                    <input id="fileupload" name="myfile" type="file" />
                </form>
                <br>
                -->
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="buttonVa">Valider</button>
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