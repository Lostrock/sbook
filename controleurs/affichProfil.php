<?php

include_once('./modeles/connexionBdd.php');
$idAmi=$_GET['idUtilisateur'];

$req="select prenom,nom,sexe,langue,ville,citationsFavorites from `utilisateur` where id=$idAmi;";

$rep = $bdd->prepare($req);
$rep->execute();
$row=$rep->fetch();
echo "<b>".$row["nom"]." ".$row["prenom"]."</b>";
echo "<table border='0'>"; //Création du tableau qui contiendra les membres



echo "<tr>";
echo "<td>";
echo "sexe : ";
echo"</td>";
echo "<td>";
echo $row["sexe"];
echo"</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "langue : ";
echo"</td>";
echo "<td>";
echo $row["langue"];
echo"</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "ville : ";
echo"</td>";
echo "<td>";
echo $row["ville"];
echo"</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "citations favorites : ";
echo"</td>";
echo "<td>";
echo $row["citationsFavorites"];
echo"</td>";
echo "</tr>";

echo "</tr>";

echo "</table>";