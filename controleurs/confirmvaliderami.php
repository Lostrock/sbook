<?php

include_once('./modeles/connexionBdd.php');
include("./modeles/requeteValiderAmi.php");
$idAmi=$_GET['idAmi'];
$idUtilisateur=$_SESSION['id'];

$req="select count(*) as count from contact where id_utilisateur1 ='".$idAmi."' and id_utilisateur2='".$idUtilisateur."' and accept='1';";


$rep = $bdd->prepare($req);
$rep->execute();
$row=$rep->fetch();
$sontDejaAmis = $row['count'];
if($sontDejaAmis>=1)
{
    echo "Vous etes deja ami avec cette personne.<br>";
    echo "Cliquez <a href=\"index.php?chemin=amis\">ici</a> revenir &agrave; la liste des amis</p>";

}
else
{
    validAmi($idUtilisateur,$idAmi,$bdd);
    echo "Ami ajout&eacute<br>";
    echo "Cliquez <a href=\"index.php?chemin=amis\">ici</a> revenir &agrave; la liste des amis</p>";

}

