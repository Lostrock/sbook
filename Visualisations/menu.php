<?php
session_start();

if(!empty($_SESSION['mail'])) 
{
    echo $_SESSION['prenom'].' '.$_SESSION['nom'];
?>
<ul>
    <li><a href="index.php?chemin=actualite" class="Lienmenu">Actualit&eacute;s</a></li>
    <li><a href="index.php?chemin=mur" class="Lienmenu">Mon mur</a></li>
    <li><a href="index.php?chemin=messageP" class="Lienmenu">Mes messages</a></li>
    <li><a href="index.php?chemin=profil" class="Lienmenu">Mon profil</a></li>
    <li><a href="index.php?chemin=amis" class="Lienmenu">Mes amis</a></li>
    <li><a href="index.php?chemin=membres" class="Lienmenu">Tous les membres</a></li>
    <li><a href="index.php?chemin=photos" class="Lienmenu">Mes photos</a></li>
    <li><a href="index.php?chemin=parametre" class="Lienmenu">G&eacute;rer mon compte</a></li>
    <li><a href="index.php?chemin=deconnexion" class="Lienmenu">D&eacute;connexion</a></li>
</ul>

<?php 

}
else
{
    echo '
         <li><a href="index.php?chemin=" class="Lienmenu">Connexion</a></li>
';
}

//session_destroy();
?>