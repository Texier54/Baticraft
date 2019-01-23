<!DOCTYPE html>
    <?php
$titre_page = "Baticraft - Connexion";
$css = '<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/chargement.css" />';
$js = '<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>';

session_start();
header('Content-type: text/html; charset=utf-8');

if(isset($_SESSION['membre_id']))
{
	header ("Refresh: 0;URL=/index.php");
}
else
{
	if(@$_POST['validate'] != 'ok')
	{
		require("../header.php");
		?>	
	
		<body>
			<div id="bloc_page">
				<div class="inscription">	
				
					<div class="center">
						<h2>Connexion</h2>
					</div>
		
					<form name="connexion" id="connexion" method="post" action="connexion.php">
						<fieldset><legend>Connexion</legend>
							<label for="pseudo" class="labelinscription">Pseudo :</label> <input type="text" class="form-control-connexion" name="pseudo" id="pseudo" placeholder="Pseudo" <?php if(isset($_COOKIE['membre_pseudo'])) echo 'value="'.$_COOKIE['membre_pseudo'].'"'; ?>/><br><br>
							<label for="mdp" class="labelinscription">Mdp :</label> <input type="password" class="form-control-connexion" name="mdp" id="mdp" placeholder="Mot de Passe"/><br><br>
							<input type="hidden" name="validate" id="validate" value="ok"/>
							<input type="checkbox" checked="checked" name="cookie" id="cookie" /> <label for="cookie">Se souvenir de moi.</label><br>
							<div class="center"><input type="submit" class="btn1" value="Connexion" /></div>
						</fieldset>
					
					</form>
				</div>
				
				<div class="inscription">
					<fieldset><legend>Connexion</legend>
						<p><a href="inscription.php">Inscription !</a><br/>
						<!-- <a class="d2" href="moncompte.php?action=reset">Mot de passe oublié!</a> -->
						<a href="forgot_mdp.php">Mot de passe oublié !</a>
						</p>
					</fieldset>
				</div>
			</div>	
		</body>
	
		<?php
	}
	else
	{
		$haut = 1; require("../header.php");
		
		// Step 2: Construct a query
		$query = "SELECT * FROM membres WHERE membre_pseudo = " . $bdd->quote($_POST['pseudo']);

		// Step 3: Send the query
		$result = $bdd->query($query);
				
				
		//$result = $bdd->query("SELECT * FROM membres WHERE membre_pseudo = '".$_POST['pseudo']."'");
		$donnees = $result->fetch(PDO::FETCH_ASSOC);

			if ($donnees['membre_banni'] == 0)
			{
				  
				if(md5($_POST['mdp']) == $donnees['membre_mdp'])
				{
					$_SESSION['membre_id'] = $donnees['membre_id'];
					$_SESSION['membre_pseudo'] = htmlspecialchars(stripslashes($donnees['membre_pseudo']));
					$_SESSION['membre_mdp'] = $donnees['membre_mdp'];
					$_SESSION['membre_grade'] = $donnees['membre_grade'];
					$bdd->query("UPDATE membres SET membre_derniere_visite='".time()."', membre_ip='" . $_SERVER['REMOTE_ADDR'] . "' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
					?>
						
					<div class="chargement">
						<section class="section">
							<span class="loader loader-quart"></span>
							Connexion
						</section>
					</div>

					<?php

					header ("Refresh: 2;URL=/index.php");
						
					if(isset($_POST['cookie']) and $_POST['cookie'] == 'on')
					{
						setcookie('membre_pseudo', $donnees['membre_pseudo'], time()+365*24*3600, "/");
						setcookie('membre_mdp', $donnees['membre_mdp'], time()+365*24*3600, "/");
					}
				}
				else
				{
					?>
					<div class="connexion">
						<div class="center"><h1>Mauvais mot de passe</h1>
						<a class="button_envoyer" href="connexion.php">Retour</a></div>
					</div>
					<?php
				}
			}
			else
			{
				?>
				<div class="connexion">
					<div class="center"><h1>Vous êtes banni !</h1>
					<a class="button_envoyer" href="index.php">Retour à l'accueil</a></div>
				</div>
				<?php
			}
		$result->closeCursor();
	}
}
?>			

<?php
	include('../footer.php');
?>
		
</html>