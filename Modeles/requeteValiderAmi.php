<?php

function validAmi($idUtilisateur,$idAmi,$bdd)
{
    $query = "update contact set accept = '1' WHERE id_utilisateur1 =:idAmi AND id_utilisateur2 =:idUtilisateur;";
    $req = $bdd->prepare($query);
    $req->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
    $req->bindValue(':idAmi', $idAmi, PDO::PARAM_STR);
    $req->execute();   
}