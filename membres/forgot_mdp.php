<!DOCTYPE html>
    <?php
$titre_page = "Baticraft - Mot de passe oublié";
$css = '<link rel="stylesheet" href="../css/style.css" />' ;
$js = '<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>';

include("../header.php");
include('../includes/fonctions.php');

?>
	
<div id="bloc_page">
	<body>
		<div class="inscription">
			<div class="center">
				<h2>Mot de passe oublié</h2>
			</div>
<?php

if(isset($_SESSION['membre_id']))
{
	$informations = Array(/*Membre qui essaie de se connecter alors qu'il l'est déjÃ */
					true,
					'Vous êtes déjà  connecté',
					'Vous êtes déjà  connecté avec le pseudo <span class="pseudoconnexion">'.htmlspecialchars($_SESSION['membre_pseudo'], ENT_QUOTES).'</span>.',
					'<a href="/membres/deconnexion.php">Se déconnecter</a>',
					ROOTPATH.'/index.php',
					5
					);
	
	require_once('../information.php');
	exit();
}
			
	if($_POST['validate-mdp'] != NULL)
	{
		if($_POST['mdp'] == $_POST['mdp_verif'] and $_POST['mdp'] != NULL and $_POST['mdp_verif'] != NULL)
		{
			$password = md5($_POST['mdp']);
			$bdd->query("UPDATE membres SET membre_mdp='" . $password . "', membre_mdp_token='' WHERE membre_mdp_token='" . $_POST['validate-mdp'] . "' ");
			?>
				<div class="center"><h1>Le mot de passe à bien était changé !</h1>
				<a class="button_envoyer" href="connexion.php">Se connecter</a></div>
			<?php
		}
		else
		{
			?>
				<div class="center"><h1>Les deux mot de passe ne sont pas identiques</h1>
				<a class="button_envoyer" href="forgot_mdp.php">Retour</a></div>
			<?php
		}
	}
	else if($_POST['validate'] != 'ok' AND $_GET['token'] == NULL)
	{
	
		?>
		<form name="connexion" method="post" action="">
			<br>
			Si vous avez oublié votre mot de passe, vous pouvez utiliser ce formulaire pour le réinitialiser. Vous recevrez un email avec les instructions.<br><br>
			<label for="mail">Adresse mail :</label> <input required class="form-control-connexion" type="text" name="mail" id="mail" placeholder="Adresse mail"/><br>
			<br><br>
			<input type="hidden" name="validate" id="validate" value="ok"/>
			<div class="center">
				<div class="g-recaptcha" data-sitekey="6LeS3QoUAAAAABBk3RYekBOO3i5kFDWet6t43bgN"></div>
			</div>
			<br>
			<div class="center"><input type="submit" class="btn1" value="Réinitialiser le mot de passe" /></div>
		</form>
		<?php
			
	}
	else if(@$_GET['token'] != NULL)
	{
		?>
		<form name="mdp" method="post" action="?">
					
		    <br>
		    Changement de mot de passe : <br><br>
			<label for="mdp" class="labelconnexion">Mot de passe :</label> <input required class="form-control-connexion" type="password" name="mdp" id="mdp"/><br>
			<label for="mdp_verif" class="labelconnexion">Mot de passe :</label> <input required class="form-control-connexion" type="password" name="mdp_verif" id="mdp_verif" placeholder="Vérification"/><br>
			<br><br>
			<input type="hidden" name="validate-mdp" id="validate-mdp" value="<?php echo $_GET['token'] ?>"/>
			<div class="center"><input type="submit" class="btn1" value="Réinitialiser le mot de passe" /></div>
					
		</form>
		<?php
	}
	else
	{
		$key = '6LeS3QoUAAAAALVqeqoZkA7C17be_mUaBM-ew111';
		$captcha = $_POST['g-recaptcha-response'];
		    $url = 'https://www.google.com/recaptcha/api/siteverify';
		    $data = array('secret' => $key, 'response' => $captcha);
		 
		    // use key 'http' even if you send the request to https://...
		    $options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data),
		    ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		 
		$result = json_decode($result);
		 
		if (0)//$result->{'success'} == false
		{
			?>
				<div class="center"><h1>Le captcha n'est pas correct !</h1>
				<a class="button_envoyer" href="forgot_mdp.php">Retour</a></div>
			<?php
		}
		else
		{
			// Step 2: Construct a query
			$query = "SELECT * FROM membres WHERE membre_mail = " . $bdd->quote($_POST['mail']);
	
			// Step 3: Send the query
			$result = $bdd->query($query);
					
					
			//$result = $bdd->query("SELECT * FROM membres WHERE membre_pseudo = '".$_POST['pseudo']."'");
			$donnees = $result->fetch(PDO::FETCH_ASSOC);
	
			if ($donnees['membre_banni'] == 0)
			{
					  
				if($_POST['mail'] == $donnees['membre_mail'])
				{
					$token = hash(sha256,substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, rand(1,10)));
					$bdd->query("UPDATE membres SET membre_mdp_token='" . $token . "' WHERE membre_mail='" . $_POST['mail'] . "' ");
					
					$destinataire = $_POST['mail'];
					// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
					$expediteur = 'Baticraft';
					$objet = 'Mot de passe perdu';
				
				  	$headers  = "From: \"Support Baticraft\"<no-reply@baticraft.tk>\n";
				  	// on indique qu'on a affaire à un email au format html avec l'entête ci-dessous
				  	$headers .= "Content-Type: text/html; charset=\"UTF-8\"";
					$body = "Bonjour, ".$_POST['mail']."<br><br>
	
					Nous avons bien recu votre demande de reinitialisation du mot de passe de votre compte texiervideos.fr ! Merci de cliquer ci dessous pour poursuivre: <br><br>
	
					<a href=\"http://baticraft.tk/membres/forgot_mdp.php?token=".$token." \">Changer mot de passe</a><br><br>
	
					Ou collez ce lien dans votre barre d'adresse: http://baticraft.tk/membres/forgot_mdp.php?token=".$token."<br><br>
	
					Si vous n'êtes pas à l'oriigine de cette demande merci de d'ignorer le mail.<br><br>
	
					L'administrateur baticraft.tk.";
							 
					if (mail($destinataire, $objet, $body, $headers)) // Envoi du message
					{
				    	echo 'Un mail vous à êtes envoyé à l\'adresse '.$_POST['mail'].', pensez à vérifier vos spams';
					}
					else // Non envoyé
					{
						echo 'Une erreur s\'est produite';
					}
					
					?>
					<?php
	                        
				}
				else
				{
					?>
					    <div class="center"><h1>Cette adresse ne correspond à aucun utilisateur</h1>
					    <a class="button_envoyer" href="forgot_mdp.php">Retour</a></div>
					<?php
				}
					    
					    
			}
			else
			{
				?>
					<div class="center"><h1>Cette adresse mail correspond à un compte banni !</h1>
					<a class="button_envoyer" href="index.php">Retour à l'accueil</a></div>
				<?php
			}
		}
	}
			
?>
			
		</div>	

</body>
</div>
	
		<?php
		include('../footer.php');
		?>
		
</html>
