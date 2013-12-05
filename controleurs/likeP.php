<?php
	include_once('../modeles/connexionBdd.php');
	session_start();
	
	//on recupere les valeurs du formulaire et on les stocks dans des variables explicites
	$expediteur = $_SESSION['id'];
	$element = trim(addslashes($_POST['idElem']));
	
	$requete_like= "INSERT INTO `like`(`id_utilisateur`, `id_element`) VALUES (".$expediteur.",".$element.");";

	$requete_verif_like="select count(id) as idC from `like` where id_utilisateur=".$expediteur." and id_element=".$element.";";
	//on execute la requete
	
	$verifLike = $bdd->prepare($requete_verif_like);
	$verifLike->execute();

	while($vlik = $verifLike->fetch())
	{
	  $verif=$vlik['idC'];

		if($verif=='0')
		{
			$like = $bdd->prepare($requete_like);
			$like->execute();
		}

	}
	
	header('Location: ../index.php?chemin=mur');
?>