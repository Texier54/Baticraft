<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
include("../includes/database.php");
//mysql_select_db("Site");
$bdd->exec('USE Site');
if (isset($_COOKIE['membre_pseudo']) and isset($_COOKIE['membre_mdp']))
{
		$result = $bdd->query("SELECT membre_id, membre_pseudo, membre_mdp, membre_grade, membre_banni FROM membres WHERE membre_pseudo = '".$_COOKIE['membre_pseudo']."'");
        $donnees = $result->fetch(PDO::FETCH_ASSOC);
				  if ($donnees['membre_banni'] == 0)
				  {
				        $_SESSION['membre_id'] = $donnees['membre_id'];
						$_SESSION['membre_pseudo'] = $donnees['membre_pseudo'];
						$_SESSION['membre_mdp'] = $donnees['membre_mdp'];
						$_SESSION['membre_grade'] = $donnees['membre_grade'];
						$bdd->query("UPDATE membres SET membre_derniere_visite='".time()."' WHERE membre_id='" . $donnees['membre_id'] . "'");
                  }
        $result->closeCursor();
}

?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">

<head>
	
	<!-- Titre du Site -->

	    <title><?php echo $titre_page; ?></title>
	
	<!-- meta -->

        <meta charset="UTF-8">
        <meta name="description" content="Baticraft est un serveur Semi-Rp | Survie | Ouvert 24/7 | Sans Whitelist | Mis à jour régulièrement. Avec un staff présent et une communauté passionnée. Rejoignez nous, on vous attend !" />
        <meta name="keywords" content="Minecraft, Baticraft, Baticraft serveur, Texier54, dynmap, Semi-RP, France, Constructions, Communauté,
	 	villes, Edenwood, Build, Survie, No-Whitelist, No-Crack, Teamspeak3, Slenderstar, Arkendia, Dawnher, Hill-Ranch, Mini-Games, Texiervideos" />
        <meta name="author" content="Baptiste Texier" />
        <meta name="copyright" content="Baticraft 2013-2016" />
		
	<!-- Scripts et Css-->

        <link rel="shortcut icon" href="/images/favicon.ico" />
        <?php echo $css; ?>
        <link rel="stylesheet" href="/css/java.css" />

</head>

<div class="barre">

	<?php
	if(isset($_SESSION['membre_id']))
	{
		?>
		<a class="liens2" href="/membres/profil.php"><?php echo $_SESSION['membre_pseudo']; ?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
		<a class="liens2" href="/membres/deconnexion.php">Deconnexion</a>
		<?php	
	}
	else
	{
		?>
		<a class="liens2" href="/membres/connexion.php">Connexion</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
		<a class="liens2" href="/membres/inscription.php">Inscription</a>
		<?php
	}
	?>

</div>

<div id="bloc_page">
  

<br><br>

	<!-- Ou copier le code ci-dessus dans les balises : -->


<div class="center">
	<div class="barreliens">
		<h3> 
		<ul id="menu">

        	<li>
                <a href="/index.php">Accueil</a>
        	</li>
        
        	<li>
                <a href="http://baticraft.tk:8123/" target="_blank">Dynmap</a>
        	</li>
        
        	<li>
                <a href="http://forum.baticraft.tk/index.php">Forum</a>
        	</li>
        
        	<li>
                <a href="/contact.php">Contact</a>
        	</li>
        
		</ul>
		</h3>
	</div>
</div>

