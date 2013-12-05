<?php

class Membres {
    
private $_id;
private $_nom;
private $_prenom;
private $_mail;
private $_mdp;
private $_dateNaiss;
private $_sexe;
private $_sexualite;
private $_situationA;
private $_langue;
private $_religion;
private $_politique;
private $_tel;
private $_cp;
private $_ville;
private $_adresse;
private $_apropos;
private $_citationsFavorites;
    

public function Membres($mail="",$nom="",$prenom="",$mdp="",$date="",$sexe="",$sexualite="",$situationA="",$langue="",$religion="",$politique="",$tel="",$cp="",$ville="",$adresse="",$apropos="",$citationsFavorites="")
{
    //$this->_id=$id;
    $this->_mail=$mail;  
    $this->_nom=$nom;
    $this->_prenom=$prenom;
    $this->_mdp=$mdp;
    $this->_dateNaiss=$date;
    $this->_sexe=$sexe;
    $this->_sexualite=$sexualite;
    $this->_situationA=$situationA;
    $this->_langue=$langue;
    $this->_religion=$religion;
    $this->_politique=$politique;
    $this->_tel=$tel;
    $this->_cp=$cp;
    $this->_ville=$ville;
    $this->_adresse=$adresse;
     $this->_apropos=$apropos;
    $this->_citationsFavorites=$citationsFavorites;
    
}
  

public function getId($mail,$bdd)
{
 $id=selectId($mail,$bdd);

    return $id;
    
}
public function getNom()
{
    return  $this->_nom;
}

public function getPrenom()
{
    return  $this->_prenom;
}

public function getMail()
{
    return  $this->_mail;
}
public function getDateNaiss()
{
    return  $this->_dateNaiss;
}
public function getSexe()
{
    return  $this->_sexe;
}
public function getReligion()
{
    return  $this->_religion;
}
public function getPolitique()
{
    return  $this->_politique;
}

public function getSexualite()
{
    return  $this->_sexualite;
}
public function getSituationA()
{
    return  $this->_situationA;
}
public  function getAdresse()
{
    return  $this->_adresse;
}

public  function getTel()
{
    return  $this->_tel;
}
public  function getVille()
{
    return  $this->_ville;
}

public  function getCp()
{
    return  $this->_cp;
}
public  function getApropos()
{
    return  $this->_apropos;
}
public  function getCitation()
{
    return  $this->_citationsFavorites;
}




public function ajouterMembre($bdd)
{
    $mail=$this->_mail;  
   $nom= $this->_nom;
    $prenom=$this->_prenom;
   $mdp= $this->_mdp;
    $dateNaiss=$this->_dateNaiss;
    $sexe=$this->_sexe;
    
    inscription($prenom,$nom,$mdp,$mail,$dateNaiss,$sexe,$bdd);
}


public function  afficheInfoGenerale()
{
      echo 'Nom : '.$this->getNom()."<br />";
    echo 'Prenom : '.$this->getPrenom()."<br />";
    echo 'Date de Naissance : '.$this->getDateNaiss()."<br />";
    echo 'Interesse par  : '.$this->_sexualite."<br />";
     echo 'Situation amoureuse : '.$this->_situationA."<br />";
    echo 'Sexe : '.$this->_sexe."<br />";
     echo 'Religion : '.$this->_religion."<br />";
     echo 'Politique : '.$this->getPolitique()."<br />";
    
    
}


public function  afficheCoordonnee()
{
    echo 'Telephone : '.$this->_tel."<br />";
    echo 'Mail  : '.$this->_mail."<br />";
     echo 'adresse : '.$this->_adresse."<br />";
     echo 'Ville : '.$this->_ville."<br />";
      echo 'Cp : '.$this->_cp."<br />";
 
    
}

public function afficheApropos()
{
     echo 'Dites-en un peu plus sru vous meme: <br /> '.$this->_apropos."<br />";
    
}
public function afficheCitation()
{
     echo " ".$this->_citationsFavorites."<br />";
    
}
              



    
}
