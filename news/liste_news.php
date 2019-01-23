<?php
	session_start();
	$js="";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   
   
   	<!-- Scripts et Css-->

	    <link rel="shortcut icon" href="../images/favicon.ico" />
	    <link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/navbar.css" />

		<title>Liste des news</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

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
            <li><a href="news.php">News</a></li>
            <li class="active"><a href="liste_news.php">Gérer</a></li>
            <li><a href="rediger_news.php">Rédiger-news</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<br><br><br><br>

<?php
if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 15)
{
  
	require("../includes/database.php");
   
   	//-----------------------------------------------------
   	// Vérification 1 : est-ce qu'on veut poster une news ?
   	//-----------------------------------------------------
   	if (isset($_POST['titre']) AND isset($_POST['sous_titre']) AND isset($_POST['contenu']))
   	{
       $titre = htmlspecialchars(stripslashes($_POST['titre']));
	   $sous_titre = htmlspecialchars(stripslashes($_POST['sous_titre']));
       $contenu = addslashes($_POST['contenu']);
	   $image =($_FILES['image']['name']);
       $auteur = ($_SESSION['membre_id']);
       // On vérifie si c'est une modification de news ou non.
       if ($_POST['id_news'] == 0)
       {
           // Ce n'est pas une modification, on crée une nouvelle entrée dans la table.
   	// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
   	if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
	{
           // Testons si le fichier n'est pas trop gros
           if ($_FILES['image']['size'] <= 4000000)
           {
                   // Testons si l'extension est autorisée
                   $infosfichier = pathinfo($_FILES['image']['name']);
                   $extension_upload = $infosfichier['extension'];
                   $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                   if (in_array($extension_upload, $extensions_autorisees))
                   {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['image']['tmp_name'], '../images/news/' . basename($_FILES['image']['name']));
                        echo "</br>L'envoi a bien été effectué !";
						echo $_FILES['image']['name'];
						   
						// Deuxième image
						$filename = '../images/news/' . basename($_FILES['image']['name']);
						$img_dst_chemin = "../images/news/little/".basename($_FILES['image']['name']);


						// Déterminer l'extension à partir du nom de fichier
						$extension = strtolower(substr(strrchr($filename,"."),1));

						// Get new dimensions
						list($width, $height) = getimagesize($filename);
						$new_width = '300';
						$new_height = '168';

						// Resample
						$image_p = imagecreatetruecolor($new_width, $new_height);

						if($extension == png)
						{
							$image2 = imagecreatefrompng($filename);
						}
						elseif($extension == jpg or jpeg)
						{
							$image2 = imagecreatefromjpeg($filename);
						}

						imagecopyresampled($image_p, $image2, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

						// Output
						if($extension == png)
						{
							imagepng( $image_p, $img_dst_chemin);
						}
						elseif($extension == jpg or jpeg)
						{
							imagejpeg( $image_p, $img_dst_chemin);
						}
						//Fin deuxième image
					
                   }
				   else echo "Une érreur est survenue !";
		   }
		   else echo "Une érreur est survenue !";
		      
	}
	else echo "Une érreur est survenue !";
   
	$bdd->query("INSERT INTO news VALUES('', '" . $titre . "', '" . $sous_titre . "', '" . $contenu . "', '" . $image . "', '" . $auteur . "', '" . time() . "')");
	$bdd->query("UPDATE membres SET membre_xp=membre_xp+100 WHERE membre_pseudo='".$_SESSION['membre_pseudo']."' ");
       
          	//-----------------------------------------------------
   			// Tweet !---------------------------------------------
   			//-----------------------------------------------------
       	
       		include('../twitter/config.php');
		
			$send_media = true;
			$path_to_media = "../images/news/".$image;
			
			$debug = FALSE;
	
			// Récupération des données dans le fichier source et attribution des variables
	
				$message = "Une nouvelle news est dipso \"".$titre."\" sur le site http://baticraft.tk/";
	
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
       else
       {
           // On protège la variable "id_news" pour éviter une faille SQL.
           $_POST['id_news'] = addslashes($_POST['id_news']);
           // C'est une modification, on met juste à jour le titre et le contenu.
           $bdd->query("UPDATE news SET titre='" . $titre . "', sous_titre='" . $sous_titre . "', contenu='" . $contenu . "' WHERE id='" . $_POST['id_news'] . "'");
       }
   }
 
   //--------------------------------------------------------
   // Vérification 2 : est-ce qu'on veut supprimer une news ?
   //--------------------------------------------------------
   if (isset($_GET['supprimer_news'])) // Si l'on demande de supprimer une news.
   {
       // Alors on supprime la news correspondante.
       // On protège la variable « id_news » pour éviter une faille SQL.
       $_GET['supprimer_news'] = addslashes($_GET['supprimer_news']);
       $bdd->query('DELETE FROM news WHERE id=\'' . $_GET['supprimer_news'] . '\'');
   }
   ?>
   
	<table class="table table-hover">
	<tr class="table table-hover">
	   <th>Modifier</th>
	   <th>Supprimer</th>
   	   <th>Titre</th>
   	   <th>Description</th>
	   <th>Auteur</th>
	   <th>Date</th>
	   <th>Miniature</th>
	</tr>
	   
   <?php
   $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC');
   while ($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les news.
   {
   	
   		   $retourauteur = $bdd->query("SELECT * FROM membres WHERE membre_id='" . $donnees['auteur'] . "' ");
   		   $donneesauteur = $retourauteur->fetch(PDO::FETCH_ASSOC);
   		   	$auteur = $donneesauteur['membre_pseudo'];
   		   $retourauteur->closeCursor();
   		   
   ?>

	<tr class="table table-hover">
		<td><?php echo '<a class="button" href="rediger_news.php?modifier_news=' . $donnees['id'] . '">'; ?>Modifier</a></td>
		<td><?php echo '<a class="button" href="liste_news.php?supprimer_news=' . $donnees['id'] . '">'; ?>Supprimer</a></td>
		<td><?php echo stripslashes($donnees['titre']); ?></td>
		<td><?php echo stripslashes($donnees['sous_titre']); ?></td>
		<td><?php echo stripslashes($auteur); ?></td>
		<td><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
		<td><a href="../images/news/<?php echo $donnees['image']; ?>"><img src="../images/news/little/<?php echo $donnees['image']; ?>" width="109.5" height="67.5" title="<?php echo stripslashes($donnees['titre']); ?>" /></a></td>
   	</tr>

   
	<?php
	} // Fin de la boucle qui liste les news.
	$retour->closeCursor();
	?>
   
    </table>
   	<br><br>
   	
   <?php
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


</div>

<?php 
include ("../footer.php");
?>

</body>

</html>