<?php
   session_start();
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/modal.js"></script>';
$nombre=0;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
    
	    <link rel="shortcut icon" href="../images/favicon.ico" />
	    <link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/navbar.css" />
		<link rel="stylesheet" href="../css/lightbox.css" />

       <title>Album</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    
    <div id="bloc_page">
        
    <body>


    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">Accueil</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="album.php">Album</a></li>
            <li><a href="gerer_album.php">Gérer</a></li>
            <li><a href="envoyer.php">Ajouter</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
        

<br><br><br><br>


<div class="center">
<?php

	require("../includes/database.php");
   
	$messagesParPage=12; //Nous allons afficher 5 messages par page.
		
	$retour_total=$bdd->query("SELECT COUNT(*) AS total FROM album "); //Nous récupérons le contenu de la requête dans $retour_total
	$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
	$total=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
		
	$retour_total->closeCursor();
 
	//Nous allons maintenant compter le nombre de pages.
	$nombreDePages=ceil($total/$messagesParPage);
 
	if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
	{
     	$pageActuelle=intval($_GET['page']);
 
     	if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     	{
			$pageActuelle=$nombreDePages;
		}
	}
	else // Sinon
	{
		$pageActuelle=1; // La page actuelle est la n°1    
	}
 
	$premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire

   $retour = $bdd->query('SELECT * FROM album ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');
   while ($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les post.
   {
		?>
		
		<div class="album">

			<a href="#" data-modal-id="<?php echo $nombre ?>" onclick="image('img<?php echo $nombre ?>');">
				<img title="<?php echo stripslashes($donnees['nom']); ?>" width="305" height="187.5" src="../images/album/little/<?php echo $donnees['image']; ?>" alt="" /><br>
				<?php echo stripslashes($donnees['nom']); ?>
			</a>
			
			
			
			<div id="<?php echo $nombre ?>" class="modal-box">
				<header> <a class="js-modal-close close">X Fermer</a><br>
					<!-- <a class="js-modal-close close"><img src="../images/cross.png" alt="Fermer"/></a> -->
					<h3><?php echo stripslashes($donnees['nom']); ?></h3>
				</header>
				
				<center><img width="100%" title="<?php echo stripslashes($donnees['nom']); ?>" id="img<?php echo $nombre ?>" image-modal-id="<?php echo $nombre ?>" src="../images/album/little/<?php echo $donnees['image']; ?>" alt="" /></center><br>
				
				<?php 
				
				$retourauteur = $bdd->query("SELECT * FROM membres WHERE membre_id='" . $donnees['auteur'] . "' ");
				$donneesauteur = $retourauteur->fetch(PDO::FETCH_ASSOC);
					$auteur = $donneesauteur['membre_pseudo'];
				$retourauteur->closeCursor();
				
				echo '<p class="auteur">By '.$auteur.'</p>';
				
				if($nombre-1 >= 0)
				{
					?> 
					<a class="btn btn-small" data-modal-id-2="<?php echo $nombre-1 ?>" onclick="image('img<?php echo $nombre-1 ?>');">Précédent</a> 
					<?php
				}
				
				
				if($nombre+1 < $messagesParPage)
				{
					?>
						<a class="btn btn-small" data-modal-id-2="<?php echo $nombre+1 ?>" onclick="image('img<?php echo $nombre+1 ?>');">Suivant</a>
	
					<?php
				}
				
				?>
				
				<footer> 
					<?php echo stripslashes($donnees['description']); ?><br><br>
					<a  class="btn btn-small js-modal-close">Fermer</a> 
				</footer>
				
			</div>
		
		</div>
		
		<?php
		$nombre = $nombre +1;
	} // Fin de la boucle qui liste les post.
	
	
	echo '<br><br><br>';
	
	//Fonction listant les pages
	function get_list_page($page, $nb_page, $link, $nb = 3){
		$list_page = array();
		for ($i=1; $i <= $nb_page; $i++)
		{
			if (($i < $nb) OR ($i > $nb_page - $nb) OR (($i < $page + $nb) AND ($i > $page -$nb)))
				$list_page[] = ($i==$page)?'<a class="pagenumeroactuel">[ '.$i.' ]</a>':'<a class="pagenumero" href="'.$link.'page='.$i.'">'.$i.'</a>'; 
			else
			{
				if ($i >= $nb AND $i <= $page - $nb)
					$i = $page - $nb;
				elseif ($i >= $page + $nb AND $i <= $nb_page - $nb)
					$i = $nb_page - $nb;
				$list_page[] = '...';
			}
		}
		$print= implode(' ', $list_page);
		return $print;
	}
			
	echo '<p align="center" >';
	echo get_list_page($pageActuelle, $nombreDePages, 'album.php?');
	echo'</p>';
			
			
   ?>

</div>

<?php include ("../footer.php"); 
?>

</body>

</div>

</html>