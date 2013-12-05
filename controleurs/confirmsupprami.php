<?php

include_once('./modeles/connexionBdd.php');
include("./modeles/requeteSupprAmi.php");
$idAmi=$_GET['idAmi'];
$idUtilisateur=$_SESSION['id'];

$req="select count(*) as count from contact where (id_utilisateur1 ='".$idUtilisateur."' and id_utilisateur2='".$idAmi."') or (id_utilisateur1 ='".$idAmi."' and id_utilisateur2='".$idUtilisateur."');";


$rep = $bdd->prepare($req);
$rep->execute();
$row=$rep->fetch();
$sontAmis = $row['count'];
if($sontAmis==1)
{
    supprAmi($idUtilisateur,$idAmi,$bdd);
    echo "Ami supprim&eacute<br>";
    echo "Cliquez <a href=\"index.php?chemin=amis\">ici</a> revenir &agrave; la liste des amis</p>";
}
else
{
    echo "Cette personne n'est pas ami avec vous<br>";
    echo "Cliquez <a href=\"index.php?chemin=amis\">ici</a> revenir &agrave; la liste des amis</p>";

}

