<?php

function ajoutAmi($idDemandeur,$idReceveur,$bdd)
{
    $query='insert into contact(id_utilisateur1,id_utilisateur2,accept) 
            value(:id1,:id2,0)';
    $req = $bdd->prepare($query);
    $req->bindValue(':id1', $idDemandeur, PDO::PARAM_STR);
    $req->bindValue(':id2', $idReceveur, PDO::PARAM_STR);
    $req->execute();   
}

