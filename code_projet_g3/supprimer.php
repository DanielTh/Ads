<?php
    require('connectionBD.php');
    
    if (isset($_POST['id'])){

    	$req = $bdd->prepare("SELECT * FROM annonces INNER JOIN users ON annonces.idAuteur = users.idU WHERE idAnnonce = :login");
    	$req->bindValue(":idAnnonce", $_POST['id']);
    	$res = $req->execute();

    	if($res['login'] != $_SESSION['login'])
    	{
    		header('Location: mesAnnonces.php?suppression=2'); 
    		exit;
    	}

        // Suppression de l'annonce
        $req = $bdd->prepare('DELETE FROM annonces WHERE idAnnonce = :idAnnonce');
        $req->bindValue(":idAnnonce", $_POST['id']);
        $res = $req->execute();
        
        header('Location:mesAnnonces.php?id='.$_POST['id']);
        header('Location:mesAnnonces.php?suppression=1');        
    }

?>