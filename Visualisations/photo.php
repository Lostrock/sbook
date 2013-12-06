<?php
$id=$_SESSION['id'];
include("./modeles/connexionBdd.php"); // On inclus la page de connexion a la bdd

?>
<form method="post" action="./index.php?chemin=photos" enctype="multipart/form-data">
  <table align='center'>
 
    <tr>
      <td> <label for="file">Poster une photo :</label><input type="file" name="file" id="file"  ></td>
    </tr>
    <tr>
      <td><input type="submit" value="valider" /></td>
    </tr>
    <tr>
        <td>
             <h1>Mes photos </h1>
        </td>
       
    </tr>
</form>


<?php


 $bdd = new PDO('mysql:host=localhost;dbname=book','root', '');
$req="select u.prenom, u.nom, e.contenu, e.date, e.id as idE from element e join utilisateur u
                on e.id_utilisateur=u.id
                where e.id_utilisateur=$id
                order by date desc";

$rep = $bdd->prepare($req);
$rep->execute();

while ($row= $rep->fetch()) 
                {

  ?>

<table class="indexTable" width="100%">
 
    <tr>
        <td><?php echo $row['contenu']; ?></td>
    </tr>
   
</table>
 





<?php
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
             header("Location: ./index.php?chemin=photos");
       }
    else
                echo "erreur: image non importée";
        }


}

 





