<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> Inscription </title>
    </head>
    <body>
        <?php
            include 'entete.php';
        ?>
        <div class="container">
            <form class="form-signin" role="form" method="post" action="formulaire.php">
                <h2 class="form-signin-heading">Formulaire d'inscription</h2> <br>
                <div class="input-group">
                    <label for="usr">Identifiant</label>
                    <input type="text" class="form-control" placeholder="Identifiant" name="id" required autofocus>
                </div>
                <br>
                <div class="input-group">
                    <label for="usr">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="usr">Mot de passe </label>
                    <input type="password" class="form-control" placeholder="Mot de passe" name="pass" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="usr">Retaper le mot de passe</label>
                    <input type="password" class="form-control" placeholder="Retaper le mot de passe" name="passConfirm" required>
                </div>
                <br>
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
