<?php

function supprAmi($idUtilisateur,$idAmi,$bdd)
{
    $query = 'delete from contact where (id_utilisateur1 = :idUtilisateur and id_utilisateur2 = :idAmi) or (id_utilisateur1 = :idAmi and id_utilisateur2 = :idUtilisateur)';
    $req = $bdd->prepare($query);
    $req->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_STR);
    $req->bindValue(':idAmi', $idAmi, PDO::PARAM_STR);
    $req->execute();   
}