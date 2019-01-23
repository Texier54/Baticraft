<?php
	session_start();
	$js="";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   
   
   	<!-- Scripts et Css-->

	    <link rel="shortcut icon" href="../images/favicon.ico" />
	    <link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/java.css" />
		<link rel="stylesheet" href="../css/navbar.css" />
		
		
       <title>News</title>
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
            <li class="active"><a href="news.php">News</a></li>
            <li><a href="liste_news.php">Gérer</a></li>
            <li><a href="rediger_news.php">Rédiger-news</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<br><br><br><br>

<?php

	require("../includes/database.php");

   	$retour = $bdd->query('SELECT * FROM news ORDER BY id DESC');
   	while ($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les post.
   	{
   		?>

   		<div class="liste_news">
   		<a href="../images/news/<?php echo $donnees['image']; ?>">
   		<img src="../images/news/little/<?php echo $donnees['image']; ?>" width="328.5" height="202.5" title="<?php echo stripslashes($donnees['titre']); ?>" /></a></br>
   		<?php echo stripslashes($donnees['titre']); ?>|
   		<?php echo stripslashes($donnees['sous_titre']); ?>|
   		<?php echo stripslashes($donnees['contenu']); ?>|
   		<?php echo date('d/m/Y', $donnees['timestamp']); ?>
   		</div>
   		
		<?php
	} // Fin de la boucle qui liste les post.

	$retour->closeCursor();
   ?>

</div>

<?php 
	include ("../footer.php");
?>

</body>

</html>