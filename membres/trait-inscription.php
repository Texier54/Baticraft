<!DOCTYPE html>
	<?php
session_start();
$titre_page = "Baticraft - Inscription";
$css = '<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="/css/connexion.css" />' ;
$js = '';

include("../header.php");

?>

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>



<?php
include('../includes/fonctions.php');

if(isset($_SESSION['membre_id']))
{
	header ("Refresh: 0;URL=/index.php");
}

   		include ("../includes/database.php");
   		$bdd->exec('USE Site');

if($_SESSION['inscrit'] == $_POST['pseudo'] && trim($_POST['inscrit']) != '')
{

	echo 'Vous avez déjà complété une inscription' ;

}

/********Étude du bazar envoyé***********/

$_SESSION['erreurs'] = 0;

//Pseudo
if(isset($_POST['pseudo_in']))
{
	$pseudo = trim($_POST['pseudo_in']);
	$pseudo_result = checkpseudo(htmlspecialchars($pseudo));
	if($pseudo_result == 'tooshort')
	{
		$_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop court, vous devez en choisir un plus long (minimum 3 caractères).</span><br/>';
		$_SESSION['form_pseudo'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($pseudo_result == 'toolong')
	{
		$_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est trop long, vous devez en choisir un plus court (maximum 32 caractères).</span><br/>';
		$_SESSION['form_pseudo'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($pseudo_result == 'exists')
	{
		$_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
		$_SESSION['form_pseudo'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($pseudo_result == 'ok')
	{
		$_SESSION['pseudo_info'] = '';
		$_SESSION['form_pseudo'] = $pseudo;
	}
	
	else if($pseudo_result == 'empty')
	{
		$_SESSION['pseudo_info'] = '<span class="erreur">Vous n\'avez pas entré de pseudo.</span><br/>';
		$_SESSION['form_pseudo'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ./index.php');
	exit();
}

//Mot de passe
if(isset($_POST['mdp_in']))
{
	$mdp = trim($_POST['mdp_in']);
	$mdp_result = checkmdp($mdp, '');
	if($mdp_result == 'tooshort')
	{
		$_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entré est trop court, changez-en pour un plus long (minimum 4 caractères).</span><br/>';
		$_SESSION['form_mdp'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($mdp_result == 'toolong')
	{
		$_SESSION['mdp_info'] = '<span class="erreur">Le mot de passe entré est trop long, changez-en pour un plus court. (maximum 20 caractères)</span><br/>';
		$_SESSION['form_mdp'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($mdp_result == 'nofigure')
	{
		$_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins un chiffre.</span><br/>';
		$_SESSION['form_mdp'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($mdp_result == 'noupcap')
	{
		$_SESSION['mdp_info'] = '<span class="erreur">Votre mot de passe doit contenir au moins une majuscule.</span><br/>';
		$_SESSION['form_mdp'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($mdp_result == 'ok')
	{
		$_SESSION['mdp_info'] = '';
		$_SESSION['form_mdp'] = $mdp;
	}
	
	else if($mdp_result == 'empty')
	{
		$_SESSION['mdp_info'] = '<span class="erreur">Vous n\'avez pas entré de mot de passe.</span><br/>';
		$_SESSION['form_mdp'] = '';
		$_SESSION['erreurs']++;

	}
}

else
{
	header('Location: ./index.php');
	echo test;
	exit();
}

//Mot de passe suite
if(isset($_POST['mdp_verif_in']))
{
	$mdp_verif = trim($_POST['mdp_verif_in']);
	$mdp_verif_result = checkmdpS($mdp_verif, $mdp);
	if($mdp_verif_result == 'different')
	{
		$_SESSION['mdp_verif_info'] = '<span class="erreur">Le mot de passe de vérification diffère du mot de passe.</span><br/>';
		$_SESSION['form_mdp_verif'] = '';
		$_SESSION['erreurs']++;
		if(isset($_SESSION['form_mdp'])) unset($_SESSION['form_mdp']);
	}
	
	else
	{
		if($mdp_verif_result == 'ok')
		{
			$_SESSION['form_mdp_verif'] = $mdp_verif;
			$_SESSION['mdp_verif_info'] = '';
		}
		
		else
		{
			$_SESSION['mdp_verif_info'] = str_replace('passe', 'passe de vérification', $_SESSION['mdp_info']);
			$_SESSION['form_mdp_verif'] = '';
			$_SESSION['erreurs']++;
		}
	}
}

else
{
	header('Location: ./index.php');
	exit();
}

//mail
if(isset($_POST['mail_in']))
{
	$mail = trim($_POST['mail_in']);
	$mail_result = checkmail($mail);
	if($mail_result == 'isnt')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' n\'est pas valide.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($mail_result == 'exists')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($mail_result == 'ok')
	{
		$_SESSION['mail_info'] = '';
		$_SESSION['form_mail'] = $mail;
	}
	
	else if($mail_result == 'empty')
	{
		$_SESSION['mail_info'] = '<span class="erreur">Vous n\'avez pas entré de mail.</span><br/>';
		$_SESSION['form_mail'] = '';
		$_SESSION['erreurs']++;	
	}
}

else
{
	header('Location: ./index.php');
	exit();
}

//date de naissance
if(isset($_POST['date_naissance']))
{
	$date_naissance = trim($_POST['date_naissance']);
	$date_naissance_result = birthdate($date_naissance);
	if($date_naissance_result == 'format')
	{
		$_SESSION['date_naissance_info'] = '<span class="erreur">Date de naissance au mauvais format ou invalide.</span><br/>';
		$_SESSION['form_date_naissance'] = '';
		$_SESSION['erreurs']++;
	}
	
	else if($date_naissance_result == 'tooyoung')
	{
		$_SESSION['date_naissance_info'] = '<span class="erreur">Agagagougougou areuh ? (Vous êtes trop jeune pour vous inscrire ici.)</span><br/>';
		$_SESSION['form_date_naissance'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($date_naissance_result == 'tooold')
	{
		$_SESSION['date_naissance_info'] = '<span class="erreur">Plus de 135 ans ? Mouais...</span><br/>';
		$_SESSION['form_date_naissance'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($date_naissance_result == 'invalid')
	{
		$_SESSION['date_naissance_info'] = '<span class="erreur">Le '.htmlspecialchars($date_naissance, ENT_QUOTES).' n\'existe pas.</span><br/>';
		$_SESSION['form_date_naissance'] = '';
		$_SESSION['erreurs']++;
	}
		
	else if($date_naissance_result == 'ok')
	{
		$_SESSION['date_naissance_info'] = '';
		$_SESSION['form_date_naissance'] = $date_naissance;
	}
	
	else if($date_naissance_result == 'empty')
	{
		$_SESSION['date_naissance_info'] = '<span class="erreur">Vous n\'avez pas entré de date de naissance.</span><br/>';
		$_SESSION['form_date_naissance'] = '';
		$_SESSION['erreurs']++;
	}
}

else
{
	header('Location: ./index.php');
	exit();
}

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
 
if ($result->{'success'} == false)
{
	$_SESSION['captcha_info'] = '<span class="erreur">Le captcha est incorrect.</span><br/>';
	$_SESSION['erreurs']++;
}


/********Entête et titre de page*********/
if($_SESSION['erreurs'] > 0) $titre = 'Erreur : Inscription 2/2';
else $titre = 'Inscription 2/2';


/**********Fin entête et titre***********/
?>
<div id="bloc_page">

<body>

		<div class="inscription">
		<!--Test des erreurs et envoi-->
			<?php
			if($_SESSION['erreurs'] == 0)
			{

				$stmt = $bdd->prepare("INSERT INTO membres (membre_pseudo, membre_mdp, membre_mail,
				membre_inscription, membre_naissance, membre_derniere_visite)
				VALUES (:pseudo, :mdp, :mail, :inscription, :naissance, :visite)");
				
				$stmt->bindParam(':pseudo', $pseudo);
				$stmt->bindParam(':mdp', $mdp);
				$stmt->bindParam(':mail', $mail);
				$stmt->bindParam(':inscription', $inscription);
				$stmt->bindParam(':naissance', $naissance);
				$stmt->bindParam(':visite', $visite);
				
				// insertion d'une ligne
				$pseudo = $pseudo;
				$mdp = md5($mdp);
				$mail = $mail;
				$inscription = time();
				$naissance = $date_naissance;
				$visite = time();

				
				if($stmt->execute()) //On éxecute la bdd prepare
				{
					$queries++;
					vidersession();
					$_SESSION['inscrit'] = $pseudo;
					/*informe qu'il s'est déjà inscrit s'il actualise, si son navigateur
					bugue avant l'affichage de la page et qu'il recharge la page, etc.*/
					
					
				?>
			<h1>Inscription validée !</h1>
			<p>Nous vous remercions de vous être inscrit sur notre site, votre inscription a été validée !<br/>
			Vous pouvez vous connecter avec vos identifiants <a href="connexion.php">ici</a>.
			</p>
				<?php
				}
				
				else
				{
					if(stripos($bdd->errorInfo(), $_SESSION['form_pseudo']) !== FALSE) // recherche du pseudo
					{
						unset($_SESSION['form_pseudo']);
						$_SESSION['pseudo_info'] = '<span class="erreur">Le pseudo '.htmlspecialchars($pseudo, ENT_QUOTES).' est déjà pris, choisissez-en un autre.</span><br/>';
						$_SESSION['erreurs']++;
					}
					
					if(stripos($bdd->errorInfo(), $_SESSION['form_mail']) !== FALSE) //recherche du mail
					{
						unset($_SESSION['form_mail']);
						unset($_SESSION['form_mail_verif']);
						$_SESSION['mail_info'] = '<span class="erreur">Le mail '.htmlspecialchars($mail, ENT_QUOTES).' est déjà pris, <a href="../contact.php">contactez-nous</a> si vous pensez à une erreur.</span><br/>';
						$_SESSION['mail_verif_info'] = str_replace('mail', 'mail de vérification', $_SESSION['mail_info']);
						$_SESSION['erreurs']++;
						$_SESSION['erreurs']++;
					}
					
					if($_SESSION['erreurs'] == 0)
					{
						$sqlbug = true; //plantage SQL.
						$_SESSION['erreurs']++;
					}
				}
			}

			if($_SESSION['erreurs'] > 0)
			{
				if($_SESSION['erreurs'] == 1) $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu 1 erreur : </span><br/>';
				else $_SESSION['nb_erreurs'] = '<span class="erreur">Il y a eu '.$_SESSION['erreurs'].' erreurs : </span><br/>';
			?>
			<h1>Inscription non validée.</h1>
			<p>Vous avez rempli le formulaire d'inscription du site et nous vous en remercions, cependant, nous n'avons
			pas pu valider votre inscription, en voici les raisons :<br/>
			<?php
				echo $_SESSION['nb_erreurs'];
				echo $_SESSION['pseudo_info'];
				echo $_SESSION['mdp_info'];
				echo $_SESSION['mdp_verif_info'];
				echo $_SESSION['mail_info'];
				echo $_SESSION['mail_verif_info'];
				echo $_SESSION['date_naissance_info'];
				echo $_SESSION['captcha_info'];
				
				if($sqlbug !== true)
				{
			?>
			Nous vous proposons donc de revenir à la page précédente pour corriger les erreurs.</p>
			<div class="center">
				<button class="btn1" onclick="self.location.href='inscription.php?pseudo=<?php echo $pseudo; ?>&mail=<?php echo $mail; ?>&naissance=<?php echo $date_naissance; ?>'">Retour</button>
			</div>
			<?php
				}
				
				else
				{
			?>
			Une erreur est survenue dans la base de données, votre formulaire semble ne pas contenir d'erreurs, donc
			il est possible que le problème vienne de notre côté, réessayez de vous inscrire ou contactez-nous.</p>
			
			<div class="center"><a href="inscription.php">Retenter une inscription</a> - <a href="/contact.php">Contactez-nous</a></div>
			<?php
				}
			}
			?>
		</div>


<?php
	include ("/footer.php"); 
?>

</body>

</div>

</html>