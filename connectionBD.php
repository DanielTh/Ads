<?php
	//Connection à la base de données SQL : annonces_database
	try{
        $bdd = new PDO('mysql:host=localhost;dbname=annonces_database;charset=utf8','root','root');
    }catch (Exception $e){
        die('Erreur :'.$e -> getMessage());
    }
?>