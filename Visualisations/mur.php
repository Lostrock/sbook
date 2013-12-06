<?php
//session_start();
include_once('./modeles/connexionBdd.php');
$mail=$_SESSION['mail'];
$id=$_SESSION['id'];
?>

<form method="post" action="./index.php?chemin=actualite" enctype="multipart/form-data">
  <table align='center'>
    <tr>
      <td>
        <textarea name="message" rows="1" cols="60"  placeholder="Exprimez-vous ! "></textarea>
      </td>
    </tr>
    <tr>
      <td> <label for="file">Importer une image :</label><input type="file" name="file" id="file"></td>
    </tr>
    <tr>
      <td><input type="submit" value="valider" /></td>
    </tr>
</form>

<?php


 $bdd = new PDO('mysql:host=localhost;dbname=book','root', '');
$req="select u.prenom, u.nom, e.contenu, e.date, e.id as idE from element e join utilisateur u
                on e.id_utilisateur=u.id
                order by date desc";

$rep = $bdd->prepare($req);
$rep->execute();

while ($row= $rep->fetch()) {
   ?>

<table class="indexTable" width="100%">
    <tr>
        <td><?php echo $row['prenom']." ".$row["nom"]; ?></td>
    </tr>
    <tr>
        <td><?php echo $row['contenu']; ?></td>
    </tr>
    <tr>
        <td><?php  echo $row['date']; ?></td>
    </tr>
</table>
 
<?php

$reqLike = "select l.id, l.id_utilisateur, l.id_element, u.nom as nom, u.prenom as prenom from `like` l inner join utilisateur u on l.id_utilisateur = u.id;";
$like = $bdd->prepare($reqLike);
$like->execute();

while($lik = $like->fetch())
{
  echo $lik['prenom'].' '.$lik['nom'].' ';
}

?>

<form name='like' method='post' action="./controleurs/like.php">
    <table class="indexTable" align='center'>
        <tr>
            <form action='./controleurs/like.php'>
              <td>
                <input type="hidden"  name="idElem"  value="<?php echo $row['idE']; ?>">
                <input type="submit" name="like" id="like" value="J'aime" />
              </td>
            </form>
        </tr>
    </table>
</form>
<?php 

$req2 = "select c.id, c.id_utilisateur, c.id_element, c.date as dateCom, c.contenu as contenuCom, u.nom as nomCom, u.prenom as prenomCom from commentaire c inner join utilisateur u on c.id_utilisateur = u.id where c.id_element=".$row['idE'].";";
$commentaire = $bdd->prepare($req2);
$commentaire->execute();

while($com = $commentaire->fetch())
{
  ?>
    <table>
        <tr>
          <td><?php echo $com['prenomCom'].' '.$com['nomCom'].' : '.$com['contenuCom'].' <i>'.$com['dateCom'].'</i>'; ?></td>
        </tr>
    </table>

  <?php
}
?>
<form name='commentaire' method='post' action='./controleurs/commentaire.php'> 
          <table align='center'>
            <tr>
              <td><input type='textarea' class="champForm" name='texte' id='texte' maxlength="300" /></td>
              <td><input type="hidden"  id="idElem" name="idElem"  value="<?php echo $row['idE']; ?>"></td>
            </tr>
            <tr>
                <td>
                  <input class='boutonvalider'  type='submit' value='Commenter' name='commentaire' id='commentaire' />
                </td>
            </tr>
          </table>
</form>
  <?php
           
    
}


        
if(isset($_POST['message']) && !empty($_POST['message']))
{
    $contenu=  htmlentities($_POST["message"]);
    $bdd = new PDO('mysql:host=localhost;dbname=book','root', '');
    $query1 = $bdd->prepare('SELECT *
                               FROM utilisateur 
                                       WHERE mail= :mail');

    $query1->bindValue(':mail', $mail, PDO::PARAM_STR);
    $query1->execute();
    $data1 = $query1->fetch();

    $id = $data1['id'];

    $mess =$contenu;

    $query = $bdd->prepare("insert into element(contenu,id_utilisateur,date)
                    values(:mess,:id,CURRENT_TIMESTAMP) ");

    $query->bindValue('mess', $mess, PDO::PARAM_STR);
    $query->bindValue('id', $id, PDO::PARAM_STR);
    $query->execute();
    header("Location: ./index.php?chemin=actualite");
}

if(!empty($_FILES))
{
   $img=$_FILES['file'];
  
   $nomImg=$img['name'];

 $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
 
$ExtensionPresumee = explode('.', $nomImg);
$ExtensionPresumeeT = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);

if ($ExtensionPresumeeT == 'jpg' || $ExtensionPresumeeT == 'jpeg'|| $ExtensionPresumeeT =='png'|| $ExtensionPresumeeT =='gif' )
{
             
    if(($nomImg)!="")
    {

        $structure = "./ressources/images/$id";
        mkdir($structure);

       $link="<img height='230' width='230' src='$structure/$nomImg'>";

        $query = $bdd->prepare("insert into element(contenu,id_utilisateur,date)
                        values(:mess,:id,CURRENT_TIMESTAMP) ");

        $query->bindValue('mess', $link, PDO::PARAM_STR);
        $query->bindValue('id', $id, PDO::PARAM_STR);
        $query->execute();
    }
       if(move_uploaded_file($img['tmp_name'],"$structure/".$img['name']))
       {
             header("Location: ./index.php?chemin=actualite");
       }
    else
                echo "erreur: image non importée";
        }


}
