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
		
		
		
        <title>Rédiger une news</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style type="text/css">
        h3, form
        {
            text-align:center;
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
            		<li><a href="news.php">News</a></li>
            		<li><a href="liste_news.php">Gérer</a></li>
            		<li class="active"><a href="rediger_news.php">Rédiger-news</a></li>
          		</ul>
        	</div><!--/.nav-collapse -->
      	</div>
    </div>

<br><br><br>
<?php

if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 15)
 {
 
	require("../includes/database.php");
   
   
   if (isset($_GET['modifier_news'])) // Si on demande de modifier une news.
   {
       // On protège la variable « modifier_news » pour éviter une faille SQL.
       $_GET['modifier_news'] = (htmlspecialchars($_GET['modifier_news']));
       // On récupère les informations de la news correspondante.
       $retour = $bdd->query('SELECT * FROM news WHERE id=\'' . $_GET['modifier_news'] . '\'');
       $donnees = $retour->fetch(PDO::FETCH_ASSOC);
    
       // On place le titre et le contenu dans des variables simples.
       $titre = htmlspecialchars(addslashes($donnees['titre']));
	   $sous_titre = htmlspecialchars(addslashes($donnees['sous_titre']));
       $contenu = stripslashes($donnees['contenu']);
       $id_news = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification.
   }
   else // C'est qu'on rédige une nouvelle news.
   {
       // Les variables $titre et $contenu sont vides, puisque c'est une nouvelle news.
       $titre = '';
	   $sous_titre = '';
       $contenu = '';
       $id_news = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification.
   }
   ?>
   
	<center>

   
   	<div class="envoyeralbum">
   		<br>
	   	<form action="liste_news.php" method="post" enctype="multipart/form-data">
		   	<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
		   	<p>Sous-titre : <input type="text" size="30" name="sous_titre" value="<?php echo $sous_titre; ?>" /></p>
		   	<p>
		       	Contenu :<br>
		       	<textarea name="contenu" cols="50" rows="10"><?php echo $contenu; ?></textarea><br>
				Envoyer une image :<br>
				<center><input type="file" name="image" /><br></center>
				<br>
		       <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" />
		       <input type="submit" class="button" value="Envoyer" />
			</p>
		</form>
	</div>
 <?php
 }
 else
 {
	?>
	<div class="center">
    	<p>Vous ne disposez pas des droits nécéssaires pour accéder à cette page.</p>
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