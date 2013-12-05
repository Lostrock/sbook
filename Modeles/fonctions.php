<?php
/************************************************************
* fonctions.php - version 1.0
* Yann Wuillaume, Jeremy Aubry  - 15/01/2013
* liste des fonctions nécessaires pour gérer la bdd
* vérifié par : GBE
************************************************************/
 
  //Variables
 global $var;
  
// connection à une bdd

 function connexion()
 {
	include ("config_bdd.php");
	$var = new PDO("mysql:host=".$host_bdd.";dbname=".$name_bdd."",$user_bdd,$pass_bdd);
	return $var;
 }
 

 
  //permet toutes les actions sur la structure et les donnees
 function query($var,$req)
 {
 
	
    include ("config_bdd.php");
	
	$chaine='SELECT ';
	$pos= strpos($req, $chaine);
	
 //si variable $req contient select alors on execute
	if($pos !== false)
	{
		$prepa=$var->prepare($req);
		$xprepa=$prepa->execute();
		$i = 0;
		while ($result = $prepa->fetch(PDO::FETCH_ASSOC))
		{
			$res[$i] = $result;				
			$i++;							
		}
	}
	// sinon  
	else
	{
		$res=$var->exec($req);
	}
	return @$res;
	
 }
?>




