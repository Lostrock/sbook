<?php

    include_once('../modeles/connexionBdd.php');
   //equire_once("../classes/Membres.php");
    include("../modeles/requeteConnexion.php");
    session_start();

$mail=  htmlentities($_POST['mailCo']);
$mdp=  htmlentities($_POST['mdpCo']);

    $message='';
    if (empty($mail) || empty($mdp) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
    Vous devez remplir tous les champs</p>
    <p>Cliquez <a href="../index.php">ici</a> pour revenir</p>';
       
    }
    
    else //On check le mot de passe
    {
         $password=verifMdp($mail,$bdd);
         $mdp=sha1($mdp);
        
         
    if ($password==$mdp ) // Acces OK !
    {
        $membreCo=identification($mail,$bdd);
     $_SESSION['id']=$membreCo->getId($mail, $bdd);
     $_SESSION['mail']=$membreCo->getMail();
      $_SESSION['nom']=$membreCo->getNom();
       $_SESSION['prenom']=$membreCo->getPrenom();
       
       
        header('Location: ../index.php?chemin=actualite');
       
      
        $message = '<p>Bienvenue 
            vous êtes maintenant connecté!</p>
            <p>Cliquez <a href="./fofo.php">ici</a>
            pour revenir au forum</p>'; 
    }
    else // Acces pas OK !
    {
             header('Location: ../index.php?chemin=actualite');
        $message = '<p>Une erreur s\'est produite
        pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a>
        pour revenir à la page précédente
        <br /><br />Cliquez <a href="./index.php">ici</a>
        pour revenir à la page d accueil</p>';
    
    }
    
    }
  
 