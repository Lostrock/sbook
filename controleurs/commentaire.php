<?php
	include_once('../modeles/connexionBdd.php');
	session_start();
	
	//on recupere les valeurs du formulaire et on les stocks dans des variables explicites
	$expediteur = $_SESSION['id'];
	$element = trim(addslashes($_POST['idElem']));
	$texte = trim(addslashes($_POST['texte']));
	$time = time()+3600;
	$time = date("Y-m-d H:i:s",$time);
	
	$requete_commentaire= "INSERT INTO `commentaire`(`id_utilisateur`, `id_element`, `date`, `contenu`) VALUES (".$expediteur.",".$element.",'".$time."','".$texte."');";

	//on execute la requete
	$commentaire = $bdd->prepare($requete_commentaire);
	$commentaire->execute();
	
	header('Location: ../index.php?chemin=actualite');
?>