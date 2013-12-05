<?php
//session_start();
$mail = $_SESSION['mail'];
$id = $_SESSION['id'];
include("./modeles/connexionBdd.php"); // On inclus la page de connexion a la bdd
include("./modeles/requeteInfoMembre.php");




if (isset($_POST['modfifInfoG']) == false && isset($_POST['modfifCoord']) == false && isset($_POST['modfifApropos'])==false && isset($_POST['modfifCitation'])==false)
    {
    ?>
    <h1>A propos </h1>


    <h4> Emplois et scolarit&eacute;</h4>



    *******************************************************************************
    <h4> Informations g&eacute;nrales</h4>
    <form method="post" action="./index.php?chemin=profil" >

        <?php
        $membre = infoG($id, $mail, $bdd);
        $membre->afficheInfoGenerale();
        ?>

        <p><input type="submit" name="modfifInfoG" value="Modifier" />
    </form>
    *******************************************************************************
    <h4> Coordonn&eacute;es</h4>

    <?php
    $membre2 = infoG($id, $mail, $bdd);
    $membre2->afficheCoordonnee();
    ?>
    <form method="post" action="./index.php?chemin=profil" >
        <p><input type="submit" name="modfifCoord" value="Modifier" />
    </form>

    *******************************************************************************
    <h4> A propos de vous </h4>
     <?php
    $membre3 = infoG($id, $mail, $bdd);
    $membre3->afficheApropos();
    ?>
    <form method="post" action="./index.php?chemin=profil" >
        <p><input type="submit" name="modfifApropos" value="Modifier" />
    </form>
    *******************************************************************************
    <h4> Citations favorites </h4>
     <?php
    $membre4 = infoG($id, $mail, $bdd);
    $membre4->afficheCitation();
    ?>
    <form method="post" action="./index.php?chemin=profil" >
        <p><input type="submit" name="modfifCitation" value="Modifier" />
    </form>

    ******************************************************************************









    <?php
}
if (isset($_POST['modfifInfoG'])) {
    

    $membre = infoG($id, $mail, $bdd);

    $prenom = $membre->getPrenom();
    $nom = $membre->getNom();
    $situation = $membre->getSituationA();
    $date = $membre->getDateNaiss();
    $year = substr($date, 0, 4);
    $month = substr($date, 6, 1) - 1;
    $day = substr($date, -2, 2);
    $sexualite = $membre->getSexualite();
    $religion = $membre->getReligion();
    $politique = $membre->getPolitique();
    ?>
    <form method='post' name='modifInfoG' action='./controleurs/verifUpdateProfil.php'>
    <center><h2>Modification Info G&eacuten&eacuterale </h2></center>

    <table border='0' align='center'>

        <tr>
            <td width='100'><b>Nom</b></td>
            <td width='200'><input type='text' name='nom' value='<?php echo $nom; ?>'/></td>
        </tr>
        <tr>
            <td width='100'><b>Pr&eacutenom</b></td>
            <td width='200'><input type='text' name='prenom'  value='<?php echo $prenom; ?>'/></td>
        </tr>

        <tr>

            <td width='100'><b>Date de Naissance</b></td>
            <td>
                <select name="jour" required>


    <?php
    echo " <option value='$day'>$day</option>";
    for ($i = 0; $i <= 31; $i++) {
        echo '<option value="' . $i . '">' . $i . '</option>';
    }
    ?>

                </select>
                <select name="mois" required>
    <?php
    $mois = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
    echo " <option value='$month'>$mois[$month]</option>";
    for ($i = 0; $i <= count($mois) - 1; $i++) {
        echo '<option value="' . $i . '">' . $mois[$i] . '</option>';
    }
    ?>
                </select>
                <select name="annees" required>

                    <?php
                    $selected = '';
                    echo " <option value='$year'>$year</option>";
                    for ($i = 1905; $i <= date('Y'); $i++) {
                        echo '<option value="', $i, '"', $selected, '>', $i, '</option>';
                        $selected = '';
                    }
                    ?>

                </select>
            </td>
        </tr>
        <tr>
            <td width='100'><b>Inter&eacutess&eacute par : </b></td>
            <td>

                <select name="sexualite" >
                    <?php
                    echo " <option value='$sexualite'>$sexualite</option>";
                    ?>

                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Homme et Femme">Homme et femme</option>

                </select>
            </td>
        </tr>
        <tr>
            <td width='100'><b>Situation amoureuse </b></td>
            <td>

                <select name="situation" >
                    <?php
                    echo " <option value='$situation'>$situation</option>";
                    ?>

                    <option value="C&eacutelibataire">C&eacutelibataire</option>
                    <option value="En couple">En Couble</option>
                </select>
            </td>
        </tr>

        <tr>
            <td width='100'><b>Sexe</b></td>
            <td width='200'>
                <input type = 'Radio' Name ='gender' value='homme' checked/><label>M</label>
                <input type = 'Radio' Name ='gender' value= 'femme'/><label>F</label></td>
        </tr>
        <tr>
            <td width='100'><b>Religion</b></td>

            <td> <textarea name="religion" rows="1" cols="60"  placeholder="Exprimez-vous ! " value='<?php echo $religion; ?>'></textarea></td>
        </tr>
        <tr>
            <td width='100'><b>Politique</b></td>
            <td> <textarea name="politique" rows="1" cols="60"  placeholder="Exprimez-vous ! " value='<?php echo $politique; ?>'></textarea></td>
        </tr>
        <tr>
            <td></td>         
            <td><input type='submit' name='submit' value='Enregistrer'/></td> 
        </tr>
    </table>
    </form>




    <?php
} else if (isset($_POST['modfifCoord'])) {
    
    
    $membre = infoG($id, $mail, $bdd);

    $tel = $membre->getTel();
    $mail= $membre->getMail();
    $adresse = $membre->getAdresse();
    $ville = $membre->getVille();
    $cp = $membre->getCp();
  
    
    ?>
    <center><h2>Modification Coordonees </h2></center>
   <form method='post' name='modifCoord' action='./controleurs/verifUpdateProfil.php'>
    <table border='0' align='center'>
        <tr>
            <td width='100'><b>t&eacutelephone</b></td>
            <td width='200'><input type='text' name='tel'  placeholder='telephone' value='<?php echo $tel; ?>'/></td>
        </tr>
        <tr>
            <td width='100'><b>mail</b></td>
            <td width='200'><input type='text' name='mail' placeholder='mail' value='<?php echo $mail; ?>'/></td>
        </tr>
        <tr>
            <td width='100'><b>adresse</b></td>
            <td width='200'><input type='text' name='adresse' placeholder='adresse' value='<?php echo $adresse; ?>'/></td>
        </tr>
        <tr>
            <td width='100'><b>ville </b></td>
            <td width='200'><input type='texte' name='ville' placeholder='ville' value='<?php echo $ville; ?>'/></td>
        </tr>
        <tr>
            <td width='100'><b>Code Postal</b></td>
            <td width='200'><input type='texte' name='cp' placeholder='Code postal' value='<?php echo $cp; ?>'/></td>
        </tr>

        <tr>
            <td></td>
            <td><input type='submit' name='submit' value='Enregistrer'/></td>
        </tr>
    </table>
   </form>



    <?php
}


 else if(isset($_POST['modfifApropos'])) {
    
    
    $membre4 = infoG($id, $mail, $bdd);
   
    echo 
    $apropos= $membre4->getApropos();
 
  
    
    ?>
    <center><h2>Modification a propos </h2></center>
   <form method='post' name='apropos' action='./controleurs/verifUpdateProfil.php'>
    <table border='0' align='center'>
       
        <tr>
            <td width='100'><b>A propos : </b></td>
            <td> <textarea name="aproposDeVous" rows="1" cols="60" /><?php echo  $apropos; ?></textarea>  </td>  
        </tr>
       
        <tr>
            <td></td>
            <td><input type='submit' name='submit' value='Enregistrer'/></td>
        </tr>
    </table>
   </form>



    <?php
}


else if(isset($_POST['modfifCitation'])) {
    
    
    $membre5 = infoG($id, $mail, $bdd);

    $citation= $membre5->getApropos();
 
  
    
    ?>
    <center><h2>Modification Citations </h2></center>
   <form method='post' name='modfifCitation' action='./controleurs/verifUpdateProfil.php'>
    <table border='0' align='center'>
       
        <tr>
            <td width='100'><b>vos citations: </b></td>
            <td> <textarea name="citation" rows="1" cols="60" ><?php echo $citation; ?></textarea>  </td>  
        </tr>
       
        <tr>
            <td></td>
            <td><input type='submit' name='submit' value='Enregistrer'/></td>
        </tr>
    </table>
   </form>



    <?php
}
?>
