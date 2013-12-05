 <?php 
/*****************************************************************
* section.php - Site E-Commerce - v1.1
* Yann Wuillaume, Jeremy Aubry, Lucas Guffroy - 08/02/2013
*
* Permet d'afficher différents contenus dans la partie section.
******************************************************************/

//On récupère la variable chemin de l'URL, et on affiche la page associée
if(!isset($_GET['chemin']))
{
	$_GET['chemin'] = '';
}
	@$chemin=$_GET['chemin'];
	switch($chemin)
	{
        case'':
		{
			include('Visualisations/connexion.php');
		};break;
            
		case'actualite':
		{
			include('Visualisations/mur.php');
		};break;
            
                case'mur':
		{
			include('Visualisations/murPerso.php');
		};break;
            
		case'messageP':
		{
			include('Visualisations/messagesprives.php');
		};break;

		case'profil':
		{
			include('Visualisations/profil.php');
		};break;
                //gestion amis------------------------
		case'amis':
		{
			include('Visualisations/amis.php');
		};break;
            
                case'ajoutami':
		{
			include('Controleurs/confirmajoutami.php');
		};break;
                
                case'supprami':
		{
			include('Controleurs/confirmsupprami.php');
		};break;
            
                case'validami':
		{
			include('Controleurs/confirmvaliderami.php');
		};break;
                //fin gestion amis---------------------
            
		case'membres':
		{
			include('Visualisations/membres.php');
		};break;
            
                case'affichprofil':
		{
			include('Controleurs/affichProfil.php');
		};break;
            

            	case'photos':
		{
			include('Visualisations/photo.php');
		};break;
            
		case'parametre':
		{
			include('Visualisations/parametre.php');
		};break;

            	case'deconnexion':
		{
			include('Visualisations/deconnexion.php');
		};break;
		
		
	}
	

?>