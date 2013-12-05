<?php
session_start();
include_once('../modeles/connexionBdd.php');
include("../modeles/requeteInfoMembre.php");
$mail = $_SESSION['mail'];



     if(isset($_POST['nom']))
     {
         
$prenom=htmlentities( $_POST['prenom']);
$nom=htmlentities( $_POST['nom']);

$jour= $_POST['jour'];
$mois= $_POST['mois']+1;
$annee= $_POST['annees'];  
$mois=sprintf('%02d', $mois);
$jour=sprintf('%02d', $jour);

 $date=$annee."-".$mois."-".$jour;
$sexe=$_POST['gender'];
$sexualite=$_POST['sexualite'];
$situation=$_POST['situation'];
$religion=htmlentities($_POST['religion']);
$politique=htmlentities($_POST['politique']);

updateProfilInfoGeneral($prenom,$nom,$date,$sexe,$sexualite,$situation,$religion,$politique,$mail,$bdd);

     }
     
if(isset($_POST['mail']))
{
    $tel=htmlentities( $_POST['tel']);
    $mail=htmlentities( $_POST['mail']);
    $adresse=htmlentities( $_POST['adresse']);
    $ville=htmlentities( $_POST['ville']);
    $cp=htmlentities( $_POST['cp']);

         updateProfilCoord($tel,$adresse,$ville,$cp,$mail,$bdd);
}
      
if(isset($_POST['aproposDeVous']))
{
    $apropos=nl2br (htmlentities( $_POST['aproposDeVous']));
    updateApropos($apropos,$mail,$bdd);
}

if(isset($_POST['citation']))
{
echo  $citation=nl2br(htmlentities( $_POST['citation']));
 
updateCitation($citation,$mail,$bdd);

}

