<?php 

function verifMail($mail,$bdd)
{       
    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail");
    $req->bindValue(':mail',$mail,PDO::PARAM_STR);
    $req->execute();
    $count = $req->rowCount();
    return $count;  
}

function inscription($prenom,$nom,$mdp,$mail,$date,$sexe,$bdd)
{
    $query='insert into utilisateur(prenom,nom,mdp,mail,date_naissance,sexe) 
            value(:prenom,:nom,:mdp,:mail,:date,:sexe)';
    $req = $bdd->prepare($query);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $req->bindValue(':mail', $mail);
    $req->bindValue(':date', $date, PDO::PARAM_STR);
    $req->bindValue(':sexe', $sexe);
    $req->execute();   
}

