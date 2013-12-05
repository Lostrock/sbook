<?php

include_once('./modeles/connexionBdd.php');
include("./modeles/requeteAjoutAmi.php");
$idAmi=$_GET['idUtilisateur'];
$idUtilisateur=$_SESSION['id'];

$req="select count(*) as count from contact where (id_utilisateur1 ='".$idUtilisateur."' and id_utilisateur2='".$idAmi."') or (id_utilisateur1 ='".$idAmi."' and id_utilisateur2='".$idUtilisateur."');";

$rep = $bdd->prepare($req);
$rep->execute();
$row=$rep->fetch();
$sontAmis = $row['count'];
if($sontAmis==0)
{
    ajoutAmi($idUtilisateur,$idAmi,$bdd);
    echo "Ami ajout&eacute<br>";
    echo "Cliquez <a href=\"index.php?chemin=membres\">ici</a> revenir &agrave; la liste des membres</p>";
}
else
{
    echo "Cette personne est d&eacutej&agrave dans votre liste d'amis<br>";
    echo "Cliquez <a href=\"index.php?chemin=membres\">ici</a> revenir &agrave; la liste des membres</p>";
}

