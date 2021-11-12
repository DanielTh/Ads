<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Site d'annonces</title>
</head>


<!-- NAVBAR
    ================================================== -->
    <body>
        <?php
        include 'entete.php';
        ?>

        <div class="container">
            <div class="row">
                <h1 style = "text-align : center" > Site d'annonces </h1>

                <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" style="height:400px">
                        <div class="item active">
                            <img class="center-block" src="images/annonce1.jpg" alt="image1">
                        </div>

                        <div class="item">
                            <img class="center-block" src="images/annonce2.jpg" alt="image2">
                        </div>

                    </div>
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div> <!-- /.carousel -->

                <h2 style="text-align: center"> Recherchez et deposez des annonces !</h2>
            </div>
        </div>

    </body>
    </html>