<?php
//session_start();

include("./modeles/connexionBdd.php"); // On inclut la page de connexion à la bdd
$idUtilisateur=$_SESSION['id'];
$req="select * from utilisateur where id !='$idUtilisateur';";

$rep=$bdd->prepare($req);
$rep->execute();




echo "<table border='0'>"; //Création du tableau qui contiendra les membres

while ($row=$rep->fetch()) //Tant qu'il y a une ligne en résultat de la requête
{
    $add="index.php?chemin=ajoutami";//Permet de définir le chemin à suivre pour le bouton ajouter
    $add.="&idUtilisateur=".$row["id"];
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
    $reqA="select count(*) as count from contact where (id_utilisateur1 ='".$idUtilisateur."' and id_utilisateur2='".$row["id"]."') or (id_utilisateur1 ='".$row["id"]."' and id_utilisateur2='".$idUtilisateur."');";
    $repA=$bdd->prepare($reqA);
    $repA->execute();

    $rowA=$repA->fetch();
    $sontAmis = $rowA['count'];
    if($sontAmis==0){ ?><a href="<?php echo $add; ?>">Ajouter</a><?php }
    
    echo"</td>";
    echo "</tr>";
}
echo "</table>";