<?php
	session_start();
	$js="";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   
   	<!-- Scripts et Css-->

	    <link rel="shortcut icon" href="../images/favicon.ico" />
	    <link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/java.css" />
		<link rel="stylesheet" href="../css/navbar.css" />

		<title>Poster une image</title>
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
            <li><a href="album.php">Album</a></li>
            <li><a href="gerer_album.php">Gérer</a></li>
            <li class="active"><a href="envoyer.php">Ajouter</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<br><br><br><br>

<?php

if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 1)
 {
 
	require("../includes/database.php");
	
   if (isset($_GET['modifier_post'])) // Si on demande de modifier un post.
   {
       // On protège la variable « modifier_post » pour éviter une faille SQL.
       $_GET['modifier_post'] = (htmlspecialchars($_GET['modifier_post']));
       // On récupère les informations du post correspondant.
       $retour = $bdd->query('SELECT * FROM album WHERE id=\'' . $_GET['modifier_post'] . '\'');
       $donnees = $retour->fetch(PDO::FETCH_ASSOC);
    
       // On place le nom, la description, l'auteur et la date dans des variables simples.
       $nom = stripslashes($donnees['nom']);
	   $description = stripslashes($donnees['description']);
       $auteur = stripslashes($donnees['auteur']);
       $id_post = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification.
   }
   else // C'est qu'on rédige un nouveau post.
   {
       // Les variables $nom et $description sont vides, puisque c'est une nouveau post.
       $nom = '';
	   $description = '';
	   $auteur = '';
       $id_post = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification.
   }
   ?>
   <center>
   <div class="envoyeralbum">
   		<br>
	   <form action="gerer_album.php" method="post" enctype="multipart/form-data">
	   <p>Nom : <input type="text" size="30" name="nom" value="<?php echo $nom; ?>" /></p>
	   <p>Description : <br><textarea type="text" cols="50" rows="10" name="description"><?php echo $description; ?></textarea></p>
		<br>
		   Envoyer une image :<br>
	       <center><input type="file" name="monfichier" /><br></center>
	       <br>
		   <input type="hidden" name="auteur" value="<?php echo $auteur; ?>" />
	       <input type="hidden" name="id_post" value="<?php echo $id_post; ?>" />
	       <input type="submit" class="button" value="Envoyer" />
	       <br><br>
	   </p>
	   </form>
   </div>
   </center>
 <?php
 }
else if (isset($_SESSION['membre_id']))
 {
	?>
	<center>
    <p>Vous ne disposez pas des droits nécéssaires pour accéder à cette page.</p>
	</center>
	 <?php
  }
else
 {
	?>
	<center>
    <p>Vous devez être connecté pour accéder à cette page.</p>
	<a class="btn1" href="../membres/connexion.php">Se connecter</a>
	</center>
	 <?php
 }
 ?>
 
</div>

<br>
<?php include ("../footer.php");?>

</body>

</html>