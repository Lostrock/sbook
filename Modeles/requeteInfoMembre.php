<?php
include("./classes/Membres.php");

 function infoG($id,$mail,$bdd)
{
    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=:mail");
    $req->bindValue(':mail',$mail,PDO::PARAM_STR);
    $req->execute();
    $ligne =$req->fetch();
    
   
    $nom=$ligne["nom"];
    $prenom=$ligne["prenom"];
    $mdp=$ligne["mdp"];
    $date=$ligne["date_naissance"];
    $sexe=$ligne["sexe"];
    $sexualite=$ligne["sexualite"];
    $situationA=$ligne["situation_amoureuse"];
    $langue=$ligne['langue'];
    $religion=$ligne['religion'];
    $politique=$ligne["politique"];  
    $tel=$ligne["telephone"];
    $cp=$ligne['cp'];
    $ville=$ligne['ville'];
    $adresse=$ligne["adresse"];
    $apropos=$ligne["apropos"];
    $citationsFavorites=$ligne["citationsFavorites"];
    
        
    $membre = new Membres($mail,$nom,$prenom,$mdp,$date,$sexe,$sexualite,$situationA,$langue,$religion,$politique,$tel,$cp,$ville,$adresse,$apropos, $citationsFavorites);
    
    return $membre;
}

 function updateProfilInfoGeneral($prenom,$nom,$date,$sexe,$sexualite,$situation,$religion,$politique,$mail,$bdd)

{
    
    $sql = "UPDATE utilisateur
               SET prenom=:prenom ,nom =:nom, date_naissance=:date, sexe=:sexe, sexualite=:sexualite, situation_amoureuse=:situation, religion=:religion, politique=:politique
               WHERE mail=:mail ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':mail',$mail);

    $req->bindValue(':nom',$nom);
    $req->bindValue(':prenom',$prenom);
    $req->bindValue(':date',$date);
    $req->bindValue(':sexe',$sexe);
    $req->bindValue(':sexualite',$sexualite);
    $req->bindValue(':situation',$situation);
    $req->bindValue(':religion',$religion);
    $req->bindValue(':politique',$politique);
    $req->execute();

     header("Location: ../index.php?chemin=profil");
    
}


 function updateProfilCoord($tel,$adresse,$ville,$cp,$mail,$bdd)

{  
    $sql = "UPDATE utilisateur
               SET ville=:ville,
               telephone =:tel,
               cp=:cp,
               adresse=:adr
              
               WHERE mail=:mail ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':mail',$mail);
    $req->bindValue(':ville',$ville);
    $req->bindValue(':tel',$tel);
    $req->bindValue(':cp',$cp);
    $req->bindValue(':adr',$adresse);
 
    $req->execute();

     header("Location: ../index.php?chemin=profil");
    
}



 function updateApropos($apropos,$mail,$bdd)

{  
    $sql = "UPDATE utilisateur
               SET apropos=:apropos
               WHERE mail=:mail ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':apropos',$apropos);
    $req->bindValue(':mail',$mail);
    $req->execute();

     header("Location: ../index.php?chemin=profil");
    
}

 function updateCitation($citations,$mail,$bdd)

{  
    $sql = "UPDATE utilisateur
               SET citationsFavorites=:citations
               WHERE mail=:mail ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':citations',$citations);
    $req->bindValue(':mail',$mail);
    $req->execute();

     header("Location: ../index.php?chemin=profil");
    
}