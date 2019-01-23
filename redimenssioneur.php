<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   
   	<!-- Scripts et Css-->

	    <link rel="shortcut icon" href="/images/favicon.png" />
	    <link rel="stylesheet" href="/css/style.css" />
		
		
       <title>TexierVideos - Redimensionneur</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
    </head>
    
    <body>
	
	<div id="bloc_page">

	<br><br><br><br>	
   <ul class="menu-vertical">
   <li class="mv-item"><a href="/index.php">Accueil</a></li>
   <li class="mv-item"><a href="/gestionnaire.php">Gestionnaire Videos</a></li>
   <li class="mv-item"><a href="/addvideo.php">Ajouter Video/Live</a></li>
   <li class="mv-item"><a href="/gestionnaireplaylist.php">Gestionnaire Playlists</a></li>
   <li class="mv-item"><a href="/addplaylist.php">Ajouter Playlist</a></li>
   <li class="mv-item"><a href="/gestionnairecommentaire.php">Gestionnaire Commentaires</a></li>
   <li class="mv-item"><a href="/gerer_membres.php">Gérer Membres</a></li>
   <li class="mv-item"><a href="/statistiques.php">Statistiques</a></li>
   <li class="mv-item-select"><a href="/redimensionneur.php">Redimensionneur</a></li>
   </ul>
<?php
   
if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 15)
{
 	
 	
	if(isset($_POST['envoie']) AND $_POST['envoie'] == 1)
	{
		// The file

		/* mysql_connect("localhost", "root", "batinews");
		mysql_select_db("texiervideos");
   		$videos = mysql_query("SELECT miniature FROM playlists ORDER BY id");
   		while ($donnees = mysql_fetch_array($videos)) // On fait une boucle pour lister les news.
   		{ 
		$nom = $donnees['miniature'];*/
		
		
		
		
		$nom = $_POST['nom'];
		$source = $_POST['source'];
		$destination = $_POST['destination'];
		$new_width = $_POST['longueur'];
		$new_height = $_POST['hauteur'];
		
		$filename = $source.$nom;
		$img_dst_chemin = $destination.$nom;

		// Get new dimensions
		list($width, $height) = getimagesize($filename);
		
		
		//$new_width = $width * $percent;
		//$new_height = $height * $percent;
		//$percent = 0.5;				
						
		// Resample
						// Déterminer l'extension à partir du nom de fichier
						$extension = strtolower(substr(strrchr($filename,"."),1));
						
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
		// Output
		//imagepng($image_p, null);

		//}
		
		?>
		
		
		<div class="addvideo">
		
		<?php echo $nom; ?>
		
		<br>
		
		Image d'origine :<br>
		<img width="300" src="<?php echo $filename; ?>"> <br>
		
		Image redimensionné :<br>
		<img width="300" src="<?php echo $img_dst_chemin; ?>"> <br>
		
		</div>
		
		<?php

	}
	else
	{
		?>	
	
		<div class="addvideo">
		
		
			<form method="post" action="">
         		<br>
         		<label>Image : </label><input required type="text" name="nom"  placeholder= "image.png"/><br><br>
				<label>Source : </label><input required type="text" name="source" value="images/"/><br><br>
				<label>Destination : </label><input required type="text" name="destination" value="images/"/><br><br>
				<label>Longueur : </label><input value="300" name="longueur" style="width:30;height:20;"><br><br>
				<label>Hauteur : </label><input value="168" name="hauteur" style="width:30;height:20;"><br><br>
				<input type="hidden" name="envoie" value="1"/>
				<br>
				<input type="submit" class="button_envoyer" value="Executer" />
			</form>
			
			
		</div>
		<?php	
	}
}
else
{
         echo '<meta http-equiv="refresh" content="0; URL=http:gestionnaire.php">';	
}

echo '<br><br>';

include ("footer.php");

?>

</body>

</html>