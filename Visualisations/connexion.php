<?php
//session_start(); // On debute la session

include_once "Modeles/fonctions.php"; // On inclus la page de connexion a la bdd


if (isset($_SESSION['login']) && $_SESSION['login'] != '') // Si on est déja connecté on va au menu
{ 
    header('Location: index_conn_ok.php');
} 
else 
{ // Sinon page de connexion
?>
   <body>
       
       <table class="indexTable" width="100%">
           <tr>
               <td>
      <!-- Formulaire de Connexion -->

      <form method='post' name='connect' action='./controleurs/verifLogin.php'>

      <center><h2>Connexion</h2></center>

        <table border='0' width='300' align='center'>
          <tr>
            <td width='100'><b>Identifiant</b></td>
            <td width='200'><input type='text' name='mailCo'/></td>
          </tr>
          <tr>
            <td width='100'><b>Mot de passe<b></td>
            <td width='200'><input type='password' name='mdpCo'/></td>
          </tr>
        </table>

      <center><input type='submit' name='submit' value='Connexion'/></center>

      </form>
      
      </td>    
      <td>
      <!-- Formulaire d'inscription -->

      <form method='post' name='inscription' action='./controleurs/verifInscription.php'>

        <center><h2>Inscription</h2></center>
        
        <table border='0' align='center'>
          <tr>
            <td width='100'><b>Pr&eacutenom</b></td>
            <td width='200'><input type='text' name='prenom'  placeholder='Pr&eacute;nom' required/></td>
          </tr>
          <tr>
            <td width='100'><b>Nom</b></td>
            <td width='200'><input type='text' name='nom' placeholder='Nom' required/></td>
          </tr>
          <tr>
            <td width='100'><b>Mail</b></td>
            <td width='200'><input type='email' name='mail' placeholder='Votre mail' required/></td>
          </tr>
          <tr>
            <td width='100'><b>Confirmation</b></td>
            <td width='200'><input type='email' name='mailVerif' placeholder='Confirmer votre mail' required/></td>
          </tr>
          <tr>
            <td width='100'><b>Mot de passe</b></td>
            <td width='200'><input type='password' name='mdp' placeholder='Mot de passe' required/></td>
          </tr>
          <tr>
            
            <td width='100'><b>Date de Naissance</b></td>
            <td>
              <select name="jour" required>
                <option value="">jour</option>

                <?php 
                  for($i=0; $i<=31; $i++)
                  {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  }
                ?>

              </select>
              <select name="mois" required>
                <option value="">Mois</option>

                <?php
                  $mois=array('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre');
                  for($i=0; $i<=count($mois)-1; $i++)
                  {
                    echo '<option value="'.$i.'">'.$mois[$i].'</option>';
                  }
                ?>

              </select>
              <select name="annees" required>
                <option value="">Annee</option>

                <?php
                  $selected = '';
                  for($i=1905; $i<=  date('Y'); $i++)
                  {
                    echo '<option value="', $i ,'"', $selected ,'>', $i ,'</option>';
                    $selected='';
                  }
                  
                ?>

              </select>
            </td>
          </tr> 
          <tr>
            <td width='100'><b>Genre</b></td>
            <td width='200'><input type = 'Radio' Name ='gender' value='homme'/><label>M</label><input type = 'Radio' Name ='gender' value= 'female'/><label>F</label></td>
          </tr>
          <tr>
            <td></td>
            <td><input type='submit' name='submit' value='Inscription'/></td>
          </tr>
        </table>
      </td>
      </tr>
      </table>

   <?php
}
