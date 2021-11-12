<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

<!-- NAVBAR ================================================== -->
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Trouvez !</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="annonces.php">Annonces</a></li>                    
                <?php
                    session_start();
                    if (isset($_SESSION['login'])){
                        echo'<li><a href="deposer.php">Déposer une annonce</a></li>
                            <li><a href="mesAnnonces.php">Mes annonces</a></li>
                            <li><a href="messages.php">Mes messages</a></ul>
                            <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$_SESSION['login'].'
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="deconnection.php">Déconnexion</a></li>
                            <li><a href="profil.php">Profil</a></li>
                            </ul>
                            </li>'; 

                        if (($_SESSION['statut'])=='admin'){
                            echo '</ul>
                            <ul class="nav navbar-nav navbar-right">
                            <li><a href="liste.php">Questionnaires</a></li>
                            <li><a href="comptes.php">Comptes</a></li>
                            </ul>';
                        }
                    }

                    else{
                        echo'</ul>
                        <ul class="nav navbar-nav navbar-right">
                        <li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
                        <li><a href="connection.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
                        </ul>';
                    }
                ?>
            </div>
        </nav>
    </body>
</html>