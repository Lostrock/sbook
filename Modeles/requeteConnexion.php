<?php 
   include("../classes/Membres.php");

function verifMdp($mail,$bdd)
{       
    
    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail");
    $req->bindValue(':mail',$mail,PDO::PARAM_STR);
    $req->execute();
    $ligne =$req->fetch();
    $mdp=$ligne["mdp"];
   
    return $mdp;  
}
function identification($mail,$bdd)
{
    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail");
    $req->bindValue(':mail',$mail,PDO::PARAM_STR);
    $req->execute();
    $ligne =$req->fetch();
    $mail=$ligne["mail"];
    $mdp=$ligne["mdp"];
    $nom=$ligne["nom"];
    $prenom=$ligne["prenom"];
    $date=$ligne["date_naissance"];
    $sexe=$ligne["sexe"];
    $membre = new Membres($mail,$nom,$prenom,$mdp,$date,$sexe);
    return $membre;
}


function selectId($mail,$bdd)
{
     $req = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail");
    $req->bindValue(':mail',$mail,PDO::PARAM_STR);
    $req->execute();
    $ligne =$req->fetch();
    $id=$ligne["id"];
    
    return $id;
    
}


