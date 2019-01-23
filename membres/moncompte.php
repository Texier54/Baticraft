<?php session_start(); $js=""; ?>
<!DOCTYPE html>
<html lang="fr">

<head>

	<meta charset="utf-8">
	<title>Moncompte</title>
	
</head>

<body> 

<div id="bloc_page">

	   <link rel="shortcut icon" href="../images/favicon.ico" />
	   <meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/navbar.css" />
        <link rel="stylesheet" href="../css/lightbox.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="../js/modal.js"></script>
    
    
    
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
            <li class="active"><a href="moncompte.php">Mon Compte</a></li>
            <li><a href="liste_membres.php">Liste des membres</a></li>
            <li><a href="profil.php">Profil</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<style>
.modal-box
{
	margin-top: 100px;
	width: 600px;
}
</style>

<?php

	if(isset($_SESSION['membre_id']))
    {
   		include ("../includes/database.php");
              
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
                        move_uploaded_file($_FILES['image']['tmp_name'], '../images/avatars/' . basename($_SESSION['membre_pseudo']. '.' . $extension_upload  ));
                        echo "</br>L'envoi a bien été effectué !";
                       
						if (isset($_POST['pseudo']) AND isset($_POST['mail']))
						{
			                 $bdd->query("UPDATE membres SET membre_avatar='" . $_SESSION['membre_pseudo'] .'.' . $extension_upload. "' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
			            }
                       
                       
                   }
				   else echo "Extension non autorisée !";
		   }
		   else echo "L'image est trop grosse 4Mo max !";
		      
   }

			if (isset($_POST['pseudo']) AND isset($_POST['mail']))
			{
				$pseudo = htmlspecialchars(stripslashes(addslashes($_POST['pseudo'])));
				$bdd->query("UPDATE membres SET membre_pseudo='" . $pseudo . "', membre_mail='" . addslashes(htmlspecialchars(stripslashes($_POST['mail']))) . "', membre_naissance='" . $_POST['anniversaire'] . "', membre_signature='" . addslashes(htmlspecialchars(stripslashes($_POST['signature']))) . "' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
				$_SESSION['membre_pseudo'] = $pseudo;
				
				if($_POST['passwordold'] != NULL AND $_POST['password'] != NULL AND $_POST['passwordconfirm'] != NULL)
				{
					$membres = $bdd->query('SELECT membre_mdp FROM membres WHERE membre_id=\'' . $_SESSION['membre_id'] . '\'');
					$donnees = $membres->fetch(PDO::FETCH_ASSOC);

					if($_POST['passwordold'] != NULL AND $_POST['password'] AND $_POST['password'] == $_POST['passwordconfirm'])
					{
						$password = md5($_POST['password']);
						$bdd->query("UPDATE membres SET membre_mdp='" . $password . "' WHERE membre_id='" . $_SESSION['membre_id'] . "' ");
						$_SESSION['membre_mdp'] = $password;						
					}
					elseif($_POST['passwordold'] != NULL AND $_POST['password'])
					{
						$erreur = 'Mauvais mot de passe';
					}
					else
					{
						$erreur = 'Les deux mots de passe ne sont pas identiques';
					}
					
					$membres->closeCursor();
				}
				
				if(isset($_COOKIE['membre_pseudo']))
				{
							setcookie('membre_pseudo', $pseudo, time()+365*24*3600, "/");
							
							if($_POST['password'] != NULL)
							setcookie('membre_mdp', $_SESSION['membre_mdp'], time()+365*24*3600, "/");
				}
			}
              
		  	$membres = $bdd->query('SELECT * FROM membres WHERE membre_pseudo=\'' . $_SESSION['membre_pseudo'] . '\'');
          	$donnees = $membres->fetch(PDO::FETCH_ASSOC);
		  
		   	$pseudo = htmlspecialchars(stripslashes($donnees['membre_pseudo']));
           	$avatar = stripslashes($donnees['membre_avatar']);	 
           	$mail = htmlspecialchars(stripslashes($donnees['membre_mail']));
           	$signature = htmlspecialchars(stripslashes($donnees['membre_signature']));
           	$anniversaire = stripslashes($donnees['membre_naissance'])

          ?>
    
		  <center>
		  
    <br><br><br>

          <div class="moncompte">
		  <br>
		  <img class="avatar" src="../images/avatars/<?php echo $avatar; ?>" width="128" height="128" title="Changer l'avatar" /></br>

		<form action="moncompte.php" method="post" enctype="multipart/form-data">
		
       			 Changer avatar :
                 <input type="file" name="image"/><br><br><br>
				 <p><font color="#55AAFF">Pseudo : </font><input type="text" size="20" name="pseudo" value="<?php echo $pseudo; ?>" /></p><br><br>
				 <font color="#55AAFF">Adresse mail : </font><input type="text" size="20" name="mail" value="<?php echo $mail; ?>" /></p><br><br>
				 
				 <a class="btn1" data-modal-id="1">Changer mot de passe</a><br>
				 
					<div id="1" class="modal-box">
			  			<header>
							<font color="#55AAFF">Ancien mot de passe : </font><input type="password" size="25" name="passwordold" /><br><br>
							<font color="#55AAFF">Nouveau mot de passe : </font><input type="password" size="25" name="password" /><br><br>
							<font color="#55AAFF">Confirmer nouveau mot de passe : </font><input type="password" size="25" name="passwordconfirm" /><br><br>
							<input type="submit" class="btn1" value="Valider">
					  	</header>
			  			<footer>
			  				<a  class="btn btn-small js-modal-close" >Annuler</a> 
			  			</footer>
					</div>
					
					<br><br>
					
                 <font color="#55AAFF">Votre langue : </font><select name="langue">
                                    <option value="choix1">Français</option>
                                                       </select></br></br>
                 <font color="#55AAFF">Signature : <br></font><textarea name="signature" cols="30" rows="1"><?php echo $signature; ?></textarea><br><br>
				<font color="#55AAFF">Anniversaire : </font><input type="text" size="10" name="anniversaire" value="<?php echo $anniversaire; ?>" /></p><br>
				<input type="submit" class="btn1" value="Valider" />
				</br></br>

		</form>
				 <font color="#55AAFF">Inscription : </font><?php echo date('d/m/Y à H\hi', $donnees['membre_inscription']); ?><br><br>
				 <font color="#55AAFF">Dernière visite : </font><?php echo date('d/m/Y à H\hi', $donnees['membre_derniere_visite']); ?><br><br>
                 <a href="moncompte.php" class="btn1">Suprimer le compte</a>
                 <br><br>
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
    <p>Vous devez être connécté pour accéder à cette page.</p>
	<a class="d2" href="../membres/connexion.php">Se connecter</a>
	</center>
	 <?php
 }
?>

<br><br><br>      

</div>

<?php include ("../footer.php"); ?>

</body>

</html>





