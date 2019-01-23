<?php
   session_start();
   $js='<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="../js/modal.js"></script>';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   
   	<!-- Scripts et Css-->

	    <link rel="shortcut icon" href="../images/favicon.ico" />
	    <link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/navbar.css" />
		<link rel="stylesheet" href="../css/lightbox.css" />
		
		<title>Album</title>
		
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
	    <style>
		.modal-box {
		  width: 400px;
		}
		</style>
	
    </head>
    
    <body>
	
	<div id="bloc_page">
 
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
            <li><a href="album.php">Album</a></li>
            <li class="active"><a href="gerer_album.php">Gérer</a></li>
            <li><a href="envoyer.php">Ajouter</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

</br></br></br>

</br>
<?php
if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 1)
{
 	
	require("../includes/database.php");
   
   //-----------------------------------------------------
   // Vérification 1 : est-ce qu'on veut poster une images ?
   //-----------------------------------------------------
   if (isset($_POST['nom']) AND isset($_POST['description']))
   {
       	$nom = htmlspecialchars(addslashes($_POST['nom']));
	   	$description = htmlspecialchars(addslashes($_POST['description']));
       	$auteur = $_SESSION['membre_id'];
	   	$image = ($_FILES['monfichier']['name']);
	   	
	   	echo $nom.$description.$auteur.$image;
       	// On vérifie si c'est une modification de post ou non.
		if ($_POST['id_post'] == 0)
		{
		   	// Ce n'est pas une modification, on crée une nouvelle entrée dans la table.
		   	// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
		   	if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
			{
				// Testons si le fichier n'est pas trop gros
				if ($_FILES['monfichier']['size'] <= 4000000)
				{
					// Testons si l'extension est autorisée
					$infosfichier = pathinfo($_FILES['monfichier']['name']);
					$extension_upload = $infosfichier['extension'];
					$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
		                   if (in_array($extension_upload, $extensions_autorisees))
		                   {
		                           // On peut valider le fichier et le stocker définitivement
		                           move_uploaded_file($_FILES['monfichier']['tmp_name'], '../images/album/' . basename($_FILES['monfichier']['name']));
		                           echo "<br>L'envoi a bien été effectué !";
								   echo $_FILES['monfichier']['name'];
								   
								// Deuxième image
								$filename = '../images/album/' . basename($_FILES['monfichier']['name']);
								$img_dst_chemin = "../images/album/little/".basename($_FILES['monfichier']['name']);
		
								echo $filename;
								echo $img_dst_chemin;
								// Déterminer l'extension à partir du nom de fichier
								$extension = strtolower(substr(strrchr($filename,"."),1));
		
								// Get new dimensions
								list($width, $height) = getimagesize($filename);
								$new_width = '300';
								$new_height = '168';
		
								// Resample
								$image_p = imagecreatetruecolor($new_width, $new_height);
		
								if($extension == 'png')
								{
									$image2 = imagecreatefrompng($filename);
								}
								elseif($extension == 'jpg' or 'jpeg')
								{
									$image2 = imagecreatefromjpeg($filename);
								}
		
								imagecopyresampled($image_p, $image2, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		
								// Output
								if($extension == 'png')
								{
									imagepng( $image_p, $img_dst_chemin);
								}
								elseif($extension == 'jpg' or 'jpeg')
								{
									imagejpeg( $image_p, $img_dst_chemin);
								}
								//Fin deuxième image
								
		                   }
						   else echo "Une érreur est survenue 1!";
				}
				else echo "Une érreur est survenue 2!";
				      
		   	}
		   	else echo "Une érreur est survenue 3!";
		
			$bdd->query("INSERT INTO album VALUES('', '" . $nom . "', '" . $description . "', '" . $auteur . "', '" . time() . "', '" . $image . "')");
			$bdd->query("UPDATE membres SET membre_xp=membre_xp+40 WHERE membre_pseudo='".$_SESSION['membre_pseudo']."' ");
			
			
          	//-----------------------------------------------------
   			// Tweet !---------------------------------------------
   			//-----------------------------------------------------
       	
       		include('../twitter/config.php');
		
			$send_media = true;
			$path_to_media = "../images/album/".$image;
			
			
			$debug = FALSE;
	
			// Récupération des données dans le fichier source et attribution des variables
	
				$message = "Une nouvelle photo est disponible dans l'album du site : http://baticraft.tk/album/album.php";
	
				require_once('../twitter/codebird.php');
	 
				\Codebird\Codebird::setConsumerKey($consumerKey, $consumerSecret);
				$cb = \Codebird\Codebird::getInstance();
				$cb->setToken($accessToken, $accessTokenSecret);
	 
				if($send_media == true){
					$params = array(
						'status' => $message,
						'media[]' => $path_to_media
					);
					$reply = $cb->statuses_updateWithMedia($params);
				}
				else{
					$params = array(
						'status' => $message,
					);
					$reply = $cb->statuses_update($params);
				}
				
				
       }
       elseif($_SESSION['membre_grade'] >= 10)
       {
           // On protège la variable "id_news" pour éviter une faille SQL.
           $_POST['id_post'] = addslashes($_POST['id_post']);
           // C'est une modification, on met juste à jour le titre et le contenu.
           $bdd->query("UPDATE album SET nom='" . $nom . "', description='" . $description . "' WHERE id='" . $_POST['id_post'] . "'");
       }
   }
 
   //--------------------------------------------------------
   // Vérification 2 : est-ce qu'on veut supprimer un post ?
   //--------------------------------------------------------
   if (isset($_GET['supprimer_post']) AND $_SESSION['membre_grade'] >= 10) // Si l'on demande de supprimer un post.
   {
       // Alors on supprime le post correspondant.
       // On protège la variable « id_post » pour éviter une faille SQL.
       $_GET['supprimer_post'] = addslashes($_GET['supprimer_post']);
       $bdd->query('DELETE FROM album WHERE id=\'' . $_GET['supprimer_post'] . '\'');
   }
   ?>

   <table class="table table-hover"><tr class="table table-hover">
   
	<?php
	if($_SESSION['membre_grade'] >= 10)
   	{
		?>
	   	<th>Modifier</th>
	   	<th>Supprimer</th>
	   	<?php
   	}
   		?>
   	   <th>Nom</th>
	   <th>Description</th>
	   <th>Auteur</th>
	   <th>Date</th>
	   <th>Miniature</th>
	</tr>

   	<?php
	$retour = $bdd->query('SELECT * FROM roleplay ORDER BY id DESC');
	while ($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les post.
	{
		$id = $donnees['id'];

		$retourauteur = $bdd->query("SELECT * FROM membres WHERE membre_id='" . $donnees['auteur'] . "' ");
		$donneesauteur = $retourauteur->fetch(PDO::FETCH_ASSOC);
			$auteur = $donneesauteur['membre_pseudo'];
		$retourauteur->closeCursor();
   ?>
          
   <tr class="table table-hover">
   
    <?php
	if($_SESSION['membre_grade'] >= 10)
   	{
   		?>
	   <td><?php echo '<a class="button" href="envoyer.php?modifier_post=' . $donnees['id'] . '">'; ?>Modifier</a></td>
	   <td><a href="" data-modal-id="<?php echo $id ?>" class="button" >Supprimer</a></td>
	   
	   
		<div id="<?php echo $id ?>" class="modal-box">
			<header>
				<h3>Supprimer</h3>
			</header>
				<p>&nbsp;&nbsp;Etes vous sur de vouloir supprimer ?</p>
				&nbsp;&nbsp;<a class="btn btn-small" href="gerer_album.php?supprimer_post=<?php echo $donnees['id']; ?>">Ok</a> 
				<a class="btn btn-small js-modal-close" >Annuler</a> 
			<footer> 
			</footer>
		</div>
		
	<?php
	
   	}
   	
   	?>



   <td><?php echo stripslashes($donnees['nom']); ?></td>
   <td><?php echo stripslashes($donnees['description']); ?></td>
   <td><?php echo stripslashes($auteur); ?></td>
   <td><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
   <td><a href="../images/album/<?php echo $donnees['image']; ?>"><img src="../images/album/little/<?php echo $donnees['image']; ?>" width="109.5" height="67.5" title="<?php echo stripslashes($donnees['nom']); ?>" /></a></td>
   </tr>
   <?php
   } // Fin de la boucle qui liste les post.
   $retour->closeCursor();
 }
else if (isset($_SESSION['membre_id']))
 {
	?>
	<div class="center">
    	<p>Vous ne disposez pas des droits nécéssaires pour accéder à cette page.</p>
	</div>
	 <?php
  }
else
 {
	?>
	<div class="center">
	    <p>Vous devez être connecté pour accéder à cette page.</p>
		<a class="btn1" href="../membres/connexion.php">Se connecter</a>
	</div>
	 <?php
 }
 ?>
</table>

</div>

<br>

<?php include ("../footer.php");?>

</body>

</html>