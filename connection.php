<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title> Connexion</title>
</head>
<body>
    <?php
    include 'entete.php';
    ?>
    <div class="container">
        <form class="form-signin" role="form" method="post" action="action.php">
            <h2 class="form-signin-heading">Veuillez vous identifier</h2> <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" placeholder="Identifiant" name="id" required autofocus>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" placeholder="Mot de passe" name="pass" required>
            </div>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="buttonCo">Se connecter</button>
            <button class="btn btn-lg btn-primary btn-block" type="button"  onclick="window.location.href='index.php'">Annuler</button>
        </form>
        <br>
        <?php 
        if($_GET['connexionechouee'] == 1)
            echo '<div class="alert alert-danger"> <strong>Erreur connexion !</strong> Identifiant ou mot de passe incorrect(s).</div>';
        ?>
    </div> 
</body>
</html>