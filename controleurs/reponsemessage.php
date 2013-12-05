<?php
	include_once('../modeles/connexionBdd.php');
	session_start();
	
	//on recupere les valeurs du formulaire et on les stocks dans des variables explicites
	$expediteur = $_SESSION['id'];
	$receveur = trim(addslashes($_POST['idDesti']));
	$texte = trim(addslashes($_POST['texte']));
	$time = time()+3600;
	$time = date("Y-m-d H:i:s",$time);
	
	$requete_nouveau_message = " INSERT INTO `message`(`expediteur`, `receveur`, `text`, `time`, `lu`) 
								 VALUES (".$expediteur.",".$receveur.",'".$texte."','".$time."',0);";	
	//on execute la requete
	$nouveau_message = $bdd->prepare($requete_nouveau_message);
	$nouveau_message->execute();
	
	header('Location: ../index.php?chemin=messageP&action=consulter&id='.$receveur);
?>