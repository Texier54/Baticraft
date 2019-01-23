<?php

function urllink($content='') {

    $content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a class="lienprincipaux" href="$0" target="_blank">$0</a>', $content);

    // Si on capte un lien tel que www.test.com, il faut rajouter le http://

    if(preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {

        $content = preg_replace('#<a class="lienprincipaux" href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a class="lienprincipaux" href="http://www.$1" target="_blank">www.$1</a>', $content);

        //preg_replace('#<a href="www\.(.+)">#i', '<a href="http://$0">$0</a>', $content);

    }

    $content = stripslashes($content);

    return $content;

}

function smiley($content='') {
	
	// Insérez vos smiley ici, dans le premier tableau smiliesName
	// Et dans la colonne correpsondante du second tableau smiliesUrl	
	// Indiquez le nom de l'image
	
	$smiliesName = array(':colere:', ':diable:', ':honte:', ':\'\\(', ':\\)', ':D', ';\\)', ':p', ':lol:', ':euh:', ':\\(', ':o', '-_-', 'xD', 'GG', '<3', ':caca:');
	$smiliesUrl  = array('mechant.png', 'diable.png', 'honte.png', 'pleure.png', 'content.png', 'heureux.png', 'clin.png', 'langue.png', 'lol.png', 'neutre.png', 'triste.png', 'huh.png', 'blase.png', 'xD.png', 'clapclap.png', 'coeur.png', 'poop.png');
	$smiliesPath = "/images/smilies/";

	for ($i = 0, $c = count($smiliesName); $i < $c; $i++) {
		$content = preg_replace('`' . $smiliesName[$i] . '`isU', '<img height="20" src="' . $smiliesPath . $smiliesUrl[$i] . '" alt="smiley" />', $content);
	}
	
	$content = stripslashes($content);
	return $content;
}

function urlsmiley($content='') {
	$content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a class="lienprincipaux" href="$0" target="_blank">$0</a>', $content);
	// Si on capte un lien tel que www.test.com, il faut rajouter le http://
	if(preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {
		$content = preg_replace('#<a class="lienprincipaux" href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a class="lienprincipaux" href="http://www.$1" target="_blank">www.$1</a>', $content);
		//preg_replace('#<a href="www\.(.+)">#i', '<a href="http://$0">$0</a>', $content);
	}

	// Insérez vos smiley ici, dans le premier tableau smiliesName
	// Et dans la colonne correpsondante du second tableau smiliesUrl	
	// Indiquez le nom de l'image
	
	$smiliesName = array(':colere:', ':diable:', ':honte:', ':\'\\(', ':\\)', ':D', ';\\)', ':p', ':lol:', ':euh:', ':\\(', ':o', '-_-', 'xD', 'GG', '<3', ':caca:');
	$smiliesUrl  = array('mechant.png', 'diable.png', 'honte.png', 'pleure.png', 'content.png', 'heureux.png', 'clin.png', 'langue.png', 'lol.png', 'neutre.png', 'triste.png', 'huh.png', 'blase.png', 'xD.png', 'clapclap.png', 'coeur.png', 'poop.png');
	$smiliesPath = "/images/smilies/";

	for ($i = 0, $c = count($smiliesName); $i < $c; $i++) {
		$content = preg_replace('`' . $smiliesName[$i] . '`isU', '<img height="20" src="' . $smiliesPath . $smiliesUrl[$i] . '" alt="smiley" />', $content);
	}
	
	$content = stripslashes($content);
	return $content;
}


function sqlquery($requete, $number)
{
	$query = $bdd->query($requete) or exit('Erreur SQL : '.mysql_error().' Ligne : '. __LINE__ .'.'); //requête
	queries();
	
	/*
	Deux cas possibles ici :
	Soit on sait qu'on a qu'une seule entrée qui sera
	retournée par SQL, donc on met $number à 1
	Soit on ne sait pas combien seront retournées,
	on met alors $number à 2.
	*/
	
	if($number == 1)
	{
		$query1 = $query->fetch(PDO::FETCH_ASSOC);

		/*mysql_free_result($query) libère le contenu de $query, je
		le fais par principe, mais c'est pas indispensable.*/
		return $query1;
	}
	
	else if($number == 2)
	{
		while($query1 = $query->fetch(PDO::FETCH_ASSOC))
		{
			$query2[] = $query1;
			/*On met $query1 qui est un array dans $query2 qui
			est un array. Ca fait un array d'arrays :o*/
		}

		return $query2;
	}
	
	else //Erreur
	{
		exit('Argument de sqlquery non renseigné ou incorrect.');
	}
}

function queries($num = 1)
{
	global $queries;
	$queries = $queries + intval($num);
}

function connexionbdd()
{
	//Définition des variables de connexion à la base de données
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='batinews';
	$bd_nom_bd='Site';

	//Connexion à la base de données
	//mysql_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	//mysql_select_db($bd_nom_bd);
	//mysql_query("set names 'utf8'");
	$bdd = new PDO("mysql:host=localhost", "root", "batinews");
	$bdd->exec('USE Site');
}

function actualiser_session()
{
	if(isset($_SESSION['membre_id']) && intval($_SESSION['membre_id']) != 0) //Vérification id
	{
		//utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
		$retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_SESSION['membre_id']), 1);
		
		//Si la requête a un résultat (id est : si l'id existe dans la table membres)
		if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
		{
			if($_SESSION['membre_mdp'] != $retour['membre_mdp'])
			{
				//Dehors vilain pas beau !
				$informations = Array(/*Mot de passe de session incorrect*/
									true,
									'Session invalide',
									'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
			
			else
			{
				//Validation de la session.
					$_SESSION['membre_id'] = $retour['membre_id'];
					$_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
					$_SESSION['membre_mdp'] = $retour['membre_mdp'];
			}
		}
	}
	
	else //On vérifie les cookies et sinon pas de session
	{
		if(isset($_COOKIE['membre_id']) && isset($_COOKIE['membre_mdp'])) //S'il en manque un, pas de session.
		{
			if(intval($_COOKIE['membre_id']) != 0)
			{
				//idem qu'avec les $_SESSION
				$retour = sqlquery("SELECT membre_id, membre_pseudo, membre_mdp FROM membres WHERE membre_id = ".intval($_COOKIE['membre_id']), 1);
				
				if(isset($retour['membre_pseudo']) && $retour['membre_pseudo'] != '')
				{
					if($_COOKIE['membre_mdp'] != $retour['membre_mdp'])
					{
						//Dehors vilain tout moche !
						$informations = Array(/*Mot de passe de cookie incorrect*/
											true,
											'Mot de passe cookie erroné',
											'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
											'',
											'membres/connexion.php',
											3
											);
						require_once('../information.php');
						vider_cookie();
						session_destroy();
						exit();
					}
					
					else
					{
						//Bienvenue :D
						$_SESSION['membre_id'] = $retour['membre_id'];
						$_SESSION['membre_pseudo'] = $retour['membre_pseudo'];
						$_SESSION['membre_mdp'] = $retour['membre_mdp'];
					}
				}
			}
			
			else //cookie invalide, erreur plus suppression des cookies.
			{
				$informations = Array(/*L'id de cookie est incorrect*/
									true,
									'Cookie invalide',
									'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
		}
		
		else
		{
			//Fonction de suppression de toutes les variables de cookie.
			if(isset($_SESSION['membre_id'])) unset($_SESSION['membre_id']);
			vider_cookie();
		}
	}
}

function vider_cookie()
{
	foreach($_COOKIE as $cle => $element)
	{
		setcookie($cle, '', time()-365*24*3600, "/", null, false, true);
	}
}

function checkpseudo($pseudo)
{
	if($pseudo == '') return 'empty';
	else if(strlen($pseudo) < 3) return 'tooshort';
	else if(strlen($pseudo) > 32) return 'toolong';
	
	else
	{
		$bdd = new PDO("mysql:host=localhost", "root", "batinews");
		$bdd->exec('USE Site');
		$result = $bdd->query("SELECT COUNT(*) AS nbr FROM membres WHERE membre_pseudo = '".$pseudo."'");
		$result_total = $result->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
		if($result_total['nbr'] > 0) return 'exists';
		else return 'ok';
	}
}

function checkmdp($mdp)
{
	if($mdp == '') return 'empty';
	else if(strlen($mdp) < 4) return 'tooshort';
	else if(strlen($mdp) > 20) return 'toolong';
	
	else
	{
		if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
		else return 'ok';
	}
}

function checkmdpS($mdp, $mdp2)
{
	if($mdp != $mdp2 && $mdp != '' && $mdp2 != '') return 'different';
	else return checkmdp($mdp);
}

function checkmail($email)
{
	if($email == '') return 'empty';
	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'isnt';
	
	else
	{
		$bdd = new PDO("mysql:host=localhost", "root", "batinews");
		$bdd->exec('USE Site');
		$result = $bdd->query("SELECT COUNT(*) AS nbr FROM membres WHERE membre_mail = '".$email."'");
		$result_total = $result->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
		if($result_total['nbr'] > 0) return 'exists';
		else return 'ok';
	}
}

function birthdate($date)
{
	if($date == '') return 'empty';

	else if(substr_count($date, '/') != 2) return 'format';
	else
	{
		$DATE = explode('/', $date);
		if(date('Y') - $DATE[2] <= 4) return 'tooyoung';
		else if(date('Y') - $DATE[2] >= 135) return 'tooold';
		
		else if($DATE[2]%4 == 0)
		{
			$maxdays = Array('31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
			if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
			else return 'ok';
		}
		
		else
		{
			$maxdays = Array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
			if($DATE[0] > $maxdays[$DATE[1]-1]) return 'invalid';
			else return 'ok';
		}
	}
}

function vidersession()
{
	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
}
?>