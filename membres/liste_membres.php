<?php
   session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
   
   
   	<!-- Scripts et Css-->

	    <link rel="shortcut icon" href="../images/favicon.ico" />
	    <link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/navbar.css" />
		
       	<title>Liste des membres</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style type="text/css">
        th, td
        {
            text-align:center;
            border:1px solid black;
        }
        table
        {
            border-collapse:collapse;
            border:2px solid black;
            margin:auto;
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
            <li><a href="moncompte.php">Mon Compte</a></li>
            <li class="active"><a href="liste_membres.php">Liste des membres</a></li>
            <li><a href="profil.php">Profil</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>  


</br></br></br>
<?php
if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 1)
 {
  
		//mysql_connect("localhost", "root", "batinews");
   		//mysql_select_db("Site");
   		include ("../includes/database.php");
   		$bdd->exec('USE Site');
   
?>

   <table class="table table-hover"><tr class="table table-hover">
   <th>Pseudo</th>
   <th>Banni</th>
   <th>Inscription</th>
   <th>Avatar</th>
   </tr>
   <?php
   
   $membres = $bdd->query("SELECT * FROM membres ORDER BY membre_id DESC");
   while ($donnees = $membres->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les news.
   {
	   $pseudo = $donnees['membre_pseudo']; 
	   ?>
	   <tr class="table table-hover">
	   <td><a href="profil.php?nom=<?php echo addslashes(htmlspecialchars(stripslashes($pseudo))) ?>"><?php echo addslashes(htmlspecialchars(stripslashes($donnees['membre_pseudo']))); ?></a></td>
	   <td><?php if($donnees['membre_banni']== 0) echo 'Non'; elseif($donnees['membre_banni'] == 1) echo 'Oui'; else echo 'Erreur'; ?></td>
	   <td><?php echo date('j/m/Y', $donnees['membre_inscription']); ?></td>
	   <td><a href="../images/avatars/<?php echo $donnees['membre_avatar']; ?>"><img src="../images/avatars/<?php echo $donnees['membre_avatar']; ?>" width="64" height="64" title="Serveur Baticraft !" /></a></td>
	   </tr>
	   <?php
   }

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
	<a class="d2" href="../membres/connexion.php">Se connecter</a>
	</center>
	 <?php
 }
   ?>
</table>

</div>
<? include ("../footer.php"); ?>
</body>

</html>