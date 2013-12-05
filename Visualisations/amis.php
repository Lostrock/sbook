<?php
//session_start();
include_once("./modeles/connexionBdd.php"); // On inclut la page de connexion à la bdd
$idUtilisateur=$_SESSION['id'];

$reqAmi1="select u.prenom, u.nom, u.id, c.id_utilisateur1 from utilisateur u join contact c
      on u.id=c.id_utilisateur2
      where c.id_utilisateur1='".$idUtilisateur."' and c.accept=1;";

$reqAmi2="select u.prenom, u.nom, u.id, c.id_utilisateur2 from utilisateur u join contact c
      on u.id=c.id_utilisateur1
      where c.id_utilisateur2='".$idUtilisateur."' and c.accept=1;";

$reqDemEnv="select u.prenom, u.nom, u.id, c.id_utilisateur1 from utilisateur u join contact c
      on u.id=c.id_utilisateur2
      where c.id_utilisateur1='".$idUtilisateur."' and c.accept=0;";

$reqDemRec="select u.prenom, u.nom, u.id, c.id_utilisateur1 from utilisateur u join contact c
      on u.id=c.id_utilisateur1
      where c.id_utilisateur2='".$idUtilisateur."' and c.accept=0;";


$repAmi1 = $bdd->prepare($reqAmi1);
$repAmi1->execute();

$repAmi2 = $bdd->prepare($reqAmi2);
$repAmi2->execute();

$repDemEnv = $bdd->prepare($reqDemEnv);
$repDemEnv->execute();

$repDemRec = $bdd->prepare($reqDemRec);
$repDemRec->execute();


echo "Amis<br>";
echo "<table border='0'>"; //Création du tableau qui contiendra les amis

while ($row=$repAmi1->fetch()) //Tant qu'il y a une ligne en résultat de la requête
{
    $suppr="./index.php?chemin=supprami";//Permet de définir le chemin à suivre pour le bouton supprimer
    $suppr.="&idAmi=".$row['id'];
    $profil="index.php?chemin=affichprofil";//Permet de définir le chemin à suivre pour le bouton ajouter
    $profil.="&idUtilisateur=".$row["id"];
    echo "<tr>";
    echo "<td>";
    echo $row['prenom']." ".$row["nom"];
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $profil; ?>">Profil</a><?php
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $suppr; ?>">Supprimer</a><?php
    echo"</td>";
    echo "</tr>";
}
while ($row=$repAmi2->fetch()) //Tant qu'il y a une ligne en résultat de la requête
{
    $suppr="./index.php?chemin=supprami";//Permet de définir le chemin à suivre pour le bouton supprimer
    $suppr.="&idAmi=".$row['id'];
    $profil="index.php?chemin=affichprofil";//Permet de définir le chemin à suivre pour le bouton ajouter
    $profil.="&idUtilisateur=".$row["id"];
    echo "<tr>";
    echo "<td>";
    echo $row['prenom']." ".$row["nom"];
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $profil; ?>">Profil</a><?php
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $suppr; ?>">Supprimer</a><?php
    echo"</td>";
    echo "</tr>";
}

echo "</table>";

echo "<br>Demandes d'amiti&eacute recues<br>";
echo "<table border='0'>"; //Création du tableau qui contiendra les amis

while ($row=$repDemRec->fetch()) //Tant qu'il y a une ligne en résultat de la requête
{
    $valider="./index.php?chemin=validami";//Permet de définir le chemin à suivre pour le bouton supprimer
    $valider.="&idAmi=".$row['id'];
    $profil="index.php?chemin=affichprofil";//Permet de définir le chemin à suivre pour le bouton ajouter
    $profil.="&idUtilisateur=".$row["id"];
    echo "<tr>";
    echo "<td>";
    echo $row['prenom']." ".$row["nom"];
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $profil; ?>">Profil</a><?php
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $valider; ?>">Accepter</a><?php
    echo"</td>";
    echo "</tr>";
}
echo "</table>";


echo "<br>Demandes d'amiti&eacute envoyees";
echo "<table border='0'>"; //Création du tableau qui contiendra les amis

while ($row=$repDemEnv->fetch()) //Tant qu'il y a une ligne en résultat de la requête
{
    $annuler="./index.php?chemin=supprami";//Permet de définir le chemin à suivre pour le bouton supprimer
    $annuler.="&idAmi=".$row['id'];
    $profil="index.php?chemin=affichprofil";//Permet de définir le chemin à suivre pour le bouton ajouter
    $profil.="&idUtilisateur=".$row["id"];
    echo "<tr>";
    echo "<td>";
    echo $row['prenom']." ".$row["nom"];
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $profil; ?>">Profil</a><?php
    echo"</td>";
    echo "<td>";
    ?><a href="<?php echo $annuler; ?>">Annuler la demande</a><?php
    echo"</td>";
    echo "</tr>";
}
echo "</table>";
