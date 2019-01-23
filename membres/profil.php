<?php session_start(); $js=""; ?>
<html>	   

	<link rel="shortcut icon" href="../images/favicon.ico" />
	<meta charset="utf-8">
	<title>Profil</title>
	   

	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/java.css" />
	<link rel="stylesheet" href="../css/navbar.css" />

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
            <li><a href="liste_membres.php">Liste des membres</a></li>
            <li class="active"><a href="profil.php">Profil</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div> 
    
    
<?php
          if(isset($_SESSION['membre_id']))
          {
		//mysql_connect("localhost", "root", "batinews");
   		//mysql_select_db("Site");
   		include ("../includes/database.php");
   		$bdd->exec('USE Site');
				 
		  if(isset($_POST['recherche']))
		  {
		  $_POST['recherche'] = addslashes($_POST['recherche']);
		  $recherche = $_POST['recherche'];
		  }
		  else
		  {
		    if(isset($_GET['nom']))
			{
		    $recherche = $_GET['nom'];
		    }
			else
			{
			$recherche = $_SESSION['membre_pseudo'];
			}
		  }
		  $membres = $bdd->query('SELECT * FROM membres WHERE membre_pseudo=\'' . $recherche . '\'');
          $donnees = $membres->fetch(PDO::FETCH_ASSOC);
		  
		   	$pseudo = htmlspecialchars(stripslashes($donnees['membre_pseudo']));
           	$avatar = $donnees['membre_avatar'];	 
           	$mail = htmlspecialchars(stripslashes($donnees['membre_mail']));
           	$signature = htmlspecialchars(stripslashes($donnees['membre_signature']));
           	$level = $donnees['membre_level'];
			$xp = $donnees['membre_xp'];
			$xplevel = 100*pow(1.2,$donnees['membre_level']-1);
			$xplevel = round($xplevel);
			$inscription = $donnees['membre_inscription'];
			$membre_derniere_visite = $donnees['membre_derniere_visite'];
          ?>
		  <center>
          <br><br><br>

				   		  <form name="connexion" id="connexion" method="post" action="profil.php">
					<label for="pseudo" class="float"></label> 
					<input type="text" name="recherche" placeholder= "Pseudo"/>
					<br/>
					<div class="center">
					<input type="submit" class="btn1" value="Rechercher" />
					</div>
					</br>
			<?php
			
			
			    if($pseudo == NULL)
                {
                    echo '<center>
                    <div class="profil">
                    	<br> Pseudo inconnu</br>
                    	<a href="profil.php" class="button">Retour</a><br><br>
                    </div></center>';
                }
            else
                {
                ?>

          			<div class="profil">
		  				<br>
		  				<a class="avatar2" title="Avatar" href="../images/avatars/<?php echo $avatar; ?>"><img class="avatar" src="../images/avatars/<?php echo $avatar; ?>" width="128" height="128" title="Changer l'avatar" /></a></br>
						<br>

				 		<font color="#55AAFF">Pseudo : </font><?php echo $pseudo; ?><br><br>
				 		<font color="#55AAFF">Adresse mail : </font><?php echo $mail; ?><br><br>
				 		<font color="#55AAFF" style="font-size: 20px">Niveau: </font><span style="border-radius: 200%; border: solid black 3px; padding: 4px 8px 4px 8px;"><?php echo $level; ?></span><br><br>
						<progress max="100" value="<?php echo ($xp*100)/(100*pow(1.2,$level-1)) ?>" form="form-id"><?php echo ($xp*100)/(100*pow(1.2,$donnees['membre_level']-1)) ?></progress><br>
						<?php echo $xp.'/'.$xplevel; ?><br><br>
				 		<font color="#55AAFF">Signature : </font><?php echo $signature; ?><br><br>
				 		<font color="#55AAFF">Inscription : </font><?php echo date('d/m/Y à H\hi', $donnees['membre_inscription']); ?><br><br>
				 		<font color="#55AAFF">Dernière visite : </font><?php echo date('d/m/Y à H\hi', $membre_derniere_visite); ?><br><br>
		 			</div>
		 
				<?php
                }
                ?>
                
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
	<a class="d2" href="../membres/connexion.php">Se connecter</a>
	</center>
	 <?php
 }
?>
</br></br></br></br>
</div>
<?php include ("../footer.php"); ?>
</body>

</html>





