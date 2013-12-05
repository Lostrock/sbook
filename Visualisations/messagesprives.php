
<?php
//session_start();

 include("./modeles/connexionBdd.php");

$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):''; //On récupère la valeur de la variable $action
 
switch($action)
{
 
case'consulter':
		{			
			if(!empty($_GET['id']))
				{
					echo "<a href=\"index.php?chemin=messageP\" class=\"Lienmenu\">Retour</a>";
					
					$requete_select_messages = "select m.id as idmessage, m.expediteur, m.receveur, m.text, m.time, m.lu, u.prenom as prenom, u.nom as nom
												from message m inner join utilisateur u
												on m.expediteur = u.id
												where (receveur =".$_SESSION['id']."
												and expediteur =".$_GET['id'].")
												or (receveur =".$_GET['id']."
												and expediteur =".$_SESSION['id'].");";
					
					
					$affichage_messages = $bdd->prepare($requete_select_messages);
					$affichage_messages->execute();
					
					while ($row=$affichage_messages->fetch()) 
					{

							?>
							<p align='center'>------------------------------------</p>
							<table align='center'>
								<tr>
									<td><?php echo $row['prenom'].' '.$row['nom']; ?></td>
								</tr>
								<tr>
									<td>
										<?php 
											echo $row['text'].'<br><i>'.$row['time'].'</i>'; 
											echo "<a href=\"index.php?chemin=messageP&action=supprimer&id=".$row['idmessage']."\" class=\"Lienmenu\">Supprimer</a>";
										?>
									</td>
								</tr>
							</table>
							
					<?php
						
					}
					
					?>
					<form name='nouveau_message' method='post' action='./controleurs/reponsemessage.php'> 
					<table align='center'>
						<tr>
							<td><input type='textarea' class="champForm" name='texte' id='texte' maxlength="300" /></td>
							<td><input type="hidden"  name="idDesti"  value="<?php echo $_GET['id']?>"></td>
						</tr>
						<tr>
								<td>
									<input class='boutonvalider'  type='submit' value='R&eacute;pondre' name='nouveau_message' id='nouveau_message' />
								</td>
						</tr>
					</table>
					</form>
<?php
						
				}
						
		};break;
            
            
case "nouveau": //2eme cas : on veut poster un nouveau mp
//Ici on a besoin de la valeur d'aucune variable :p
 {

			$idUtilisateur=$_SESSION['id'];

			$reqAmi1="select u.prenom, u.nom, u.id as id1, c.id_utilisateur1 from utilisateur u join contact c
            on u.id=c.id_utilisateur2
			where c.id_utilisateur1='".$idUtilisateur."' and c.accept=1;";

			$reqAmi2="select u.prenom, u.nom, u.id as id2, c.id_utilisateur2 from utilisateur u join contact c
			on u.id=c.id_utilisateur1
            where c.id_utilisateur2='".$idUtilisateur."' and c.accept=1;";

            $repAmi1 = $bdd->prepare($reqAmi1);
			$repAmi1->execute();

			$repAmi2 = $bdd->prepare($reqAmi2);
			$repAmi2->execute();
?>
<form name='nouveau_message' method='post' action='./controleurs/nouveaumessage.php'> 
<h2> Nouveau message</h2>

<table>	
    
	<tr>
        <td> 
			<select name='idDesti' class="champForm" style="width:153px"  >
			<?php
					while ($row=$repAmi1->fetch()) //Tant qu'il y a une ligne en résultat de la requête
					{
						?>
							<option value="<?php echo $row['id1']; ?>" ><?php echo $row['prenom']." ".$row["nom"]; ?></option>
						<?php
					}
					while ($row=$repAmi2->fetch()) //Tant qu'il y a une ligne en résultat de la requête
					{   
						?>						
							<option value="<?php echo $row['id2']; ?>" ><?php echo $row['prenom']." ".$row["nom"]; ?></option>
						<?php
					}
					
			?>
			</select>
		</td>
	</tr>
	<tr>
        <td> <input type='textarea' class="champForm" name='texte' id='texte' maxlength="300" /></td>
    </tr>
	<tr>
            <td>
                <input class='boutonvalider'  type='submit' value='Envoyer' name='nouveau_message' id='nouveau_message' />
                <input class='boutonretour' type='button' value='Retour' onclick='javascript:history.back()'/>
            </td>
	</tr>
</table>
</form>

<?php  }
break;
  
case "supprimer": //4eme cas : on veut supprimer un mp reçu
//Ici on a besoin de la valeur de l'id du mp à supprimer
		$message = $_GET['id'];
		$requete_suppression = "delete from message where id=".$message.";";
		
		$repSup = $bdd->prepare($requete_suppression);
		$repSup->execute();
        echo "Le message &agrave; &eacute;t&eacute; supprim&eacute;<br>";
        echo "<a href=\"index.php?chemin=messageP&action=consulter\" class=\"Lienmenu\">Retour</a>";
break;
 
default; //Si rien n'est demandé ou s'il y a une erreur dans l'url, on affiche la boite de mp.
    
    echo "<a href=\"index.php?chemin=messageP&action=nouveau\" class=\"Lienmenu\">Nouveau message</a><br>";
    echo "Liste de contacts";
    
	$idUtilisateur=$_SESSION['id'];

	$reqAmi1="select u.prenom, u.nom, u.id as id1, c.id_utilisateur1 from utilisateur u join contact c
		      on u.id=c.id_utilisateur2
		      where c.id_utilisateur1='".$idUtilisateur."' and c.accept=1;";

	$reqAmi2="select u.prenom, u.nom, u.id as id2, c.id_utilisateur2 from utilisateur u join contact c
		      on u.id=c.id_utilisateur1
		      where c.id_utilisateur2='".$idUtilisateur."' and c.accept=1;";

	$repAmi1 = $bdd->prepare($reqAmi1);
	$repAmi1->execute();

	$repAmi2 = $bdd->prepare($reqAmi2);
	$repAmi2->execute();

	echo "<table border='0'>"; //Création du tableau qui contiendra les amis

	while ($row=$repAmi1->fetch()) //Tant qu'il y a une ligne en résultat de la requête
	{
		?>
		<tr>
			<td><?php echo $row['prenom']." ".$row["nom"]; ?></td>
			<td><a href="index.php?chemin=messageP&action=consulter&id=<?php echo $row['id1']; ?>">Discussion</a></td>
		</tr>
		<?php
	}
	while ($row=$repAmi2->fetch()) //Tant qu'il y a une ligne en résultat de la requête
	{   
		?>
		<tr>
			<td><?php echo $row['prenom']." ".$row["nom"]; ?></td>
			<td><a href="index.php?chemin=messageP&action=consulter&id=<?php echo $row['id2']; ?>">Discussion</a></td>
		</tr>
		<?php
	}

	echo "</table>";
		
					
					}

    
 //fin du switch

?>