<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
require("includes/database.php");

if (isset($_COOKIE['membre_pseudo']) and isset($_COOKIE['membre_mdp']))
{
	if(!isset($_SESSION['membre_id']))
	{
		$result = $bdd->query("SELECT membre_id, membre_pseudo, membre_mdp, membre_grade, membre_banni FROM membres WHERE membre_pseudo = '".$_COOKIE['membre_pseudo']."'");
        $donnees = $result->fetch(PDO::FETCH_ASSOC);
		if ($donnees['membre_banni'] == 0 AND $_COOKIE['membre_mdp'] == $donnees['membre_mdp'])
		{
			$_SESSION['membre_id'] = $donnees['membre_id'];
			$_SESSION['membre_pseudo'] = htmlspecialchars(stripslashes($donnees['membre_pseudo']));
			$_SESSION['membre_mdp'] = $donnees['membre_mdp'];
			$_SESSION['membre_grade'] = $donnees['membre_grade'];
		}
        $result->closeCursor();
	}
	$result = $bdd->query("SELECT membre_derniere_visite, membre_xp, membre_level FROM membres WHERE membre_pseudo = '".$_COOKIE['membre_pseudo']."'");
	$donnees = $result->fetch(PDO::FETCH_ASSOC);
		$xplevel = 100*pow(1.2,$donnees['membre_level']-1);
		$xplevel = round($xplevel);
	if(date('d', $donnees['membre_derniere_visite']) != date('d'))
		$bdd->query("UPDATE membres SET membre_xp=membre_xp+10 WHERE membre_id='" . $_SESSION['membre_id'] . "' ");
	if($donnees['membre_xp']>= $xplevel) //Level up
	{
		$bdd->query("UPDATE membres SET membre_level=membre_level+1, membre_xp=membre_xp-$xplevel  WHERE membre_id='" . $_SESSION['membre_id'] . "' ");
		$levelup = 'yes';
	}
	$result->closeCursor();
	 
	$bdd->query("UPDATE membres SET membre_derniere_visite='".time()."', membre_ip='" . $_SERVER['REMOTE_ADDR'] . "' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
}

if(@$_SESSION['membre_id']) $utilisateur = $_SESSION['membre_id']; else $utilisateur = "";
$bdd->query("INSERT INTO stats SET ip='" . $_SERVER['REMOTE_ADDR'] . "', page='" . $_SERVER['PHP_SELF']  . "', utilisateur='" . $utilisateur ."', date='".time()."' ");

?>

<html lang="fr">

<head>
	
	<!-- Titre du Site -->

	    <title><?php echo $titre_page; ?></title>
	
	<!-- meta -->

        <meta charset="UTF-8">
        <meta name="description" content="Baticraft est un serveur Semi-Rp | Survie | Ouvert 24/7 | Sans Whitelist | Mis à jour régulièrement. Avec un staff présent et une communauté passionnée. Rejoignez nous, on vous attend !" />
        <meta name="keywords" content="Minecraft, Baticraft, Baticraft serveur, Texier54, dynmap, Semi-RP, France, Constructions, Communauté,
	 	villes, Edenwood, Build, Survie, No-Whitelist, No-Crack, Teamspeak3, Slenderstar, Arkendia, Dawnher, Hill-Ranch, Mini-Games, Texiervideos" />
        <meta name="author" content="Baptiste Texier" />
        <meta name="copyright" content="Baticraft 2013-<?php echo date('Y'); ?>" />
		
	<!-- Scripts et Css-->

        <link rel="shortcut icon" href="/images/favicon.ico" />
        <link rel="stylesheet" href="/css/java.css" />
        <link rel="stylesheet" href="/css/lightbox.css" />
        <?php echo $css; ?>

</head>

<div class="barre">

	<?php
	if(isset($_SESSION['membre_id']))
	{
		?>
		<a class="liens2" href="" data-modal-id="profil"><?php echo $_SESSION['membre_pseudo']; ?></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
		<div id="profil" style="max-width: 600px;" class="modal-box">
			<header>
				<h3>Profil</h3>
				<a class="js-modal-close close">X Fermer</a>
			</header>
						  		
			<div class="center">
			<?php
				$membres = $bdd->query('SELECT membre_id, membre_pseudo, membre_mail, membre_naissance, membre_level, membre_xp, membre_banni, membre_avatar, membre_signature, membre_inscription FROM membres WHERE membre_id=\'' . $_SESSION['membre_id'] . '\'');
				$donnees = $membres->fetch(PDO::FETCH_ASSOC);
								  		
					$id = $donnees['membre_id'];
					$pseudo = htmlspecialchars(stripslashes($donnees['membre_pseudo']));
					$avatar = $donnees['membre_avatar'];
					$mail = stripslashes($donnees['membre_mail']);
					$level = $donnees['membre_level'];
					$xp = $donnees['membre_xp'];
					$xplevel = 100*pow(1.2,$donnees['membre_level']-1);
					$xplevel = round($xplevel);
					$signature = stripslashes($donnees['membre_signature']);
					$inscription = $donnees['membre_inscription'];
				$membres->closeCursor();
									
			?>
				<br>
				<font color="#55AAFF" style="font-size: 20px">Pseudo : </font><?php echo $pseudo; ?><br><br>
				<font color="#55AAFF" style="font-size: 20px">Adresse mail : </font><?php echo $mail; ?><br><br>
				<font color="#55AAFF" style="font-size: 20px">Niveau: </font><span style="border-radius: 200%; border: solid black 3px; padding: 4px 8px 4px 8px;"><?php echo $level; ?></span><br><br>
				<progress max="100" value="<?php echo ($xp*100)/(100*pow(1.2,$level-1)) ?>" form="form-id"><?php echo ($xp*100)/(100*pow(1.2,$level-1)) ?></progress><br>
				<?php echo $xp.'/'.$xplevel; ?><br><br>
				<font color="#55AAFF" style="font-size: 20px">Signature : </font><?php echo $signature; ?><br><br>
				<font color="#55AAFF" style="font-size: 20px">Inscription : </font><?php echo date('d/m/Y à H\hi', $inscription); ?><br><br>
								
				<a href="membres/moncompte.php" class="button">Editer profil</a>
									
			</div>
								
			<footer> 
			</footer>
						
		</div>
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

<br><br>

<div id="bloc_page">

<?php
if(@$levelup == 'yes')
{
	?>
	<div id="levelup" class="modal-box" style="display: block; max-width: 600px; text-align: center;">
  		<header>
    		<h3>Profil</h3>
    		<a class="js-modal-close close">X Fermer</a>
  		</header>
  		
			<br>
			<font color="#55AAFF" style="font-size: 20px">Vous avez level up !</font><br><br>
			<font color="#55AAFF" style="font-size: 20px">Vous êtes désormais level <?php echo $level; ?> !</font><br><br>
		
  		<footer> 
  		</footer>

	</div>
	<?php
}

	echo '<br><br>';
	
if(!isset($haut))
{
	?>
	
	<div class="carousel">	
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
			  </ol>
			
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			  
			    <div class="item active">
			
			      <img src="/images/carousel/Dawnher.jpg" alt="Baticraft">
			
			      <div class="carousel-caption">
			       <h3>Dawnher</h3>
			      </div>
			    </div>
	
			
				<div class="item">
			
			      <img src="/images/carousel/ThunderHawk.png" alt="Baticraft">
			
			      <div class="carousel-caption">
			       <h3>ThunderHawk</h3>
			      </div>
			    </div>
			      
			      
			    <div class="item">
			
			      <img src="/images/carousel/PaintBall.png" alt="Baticraft">
			
			      <div class="carousel-caption">
			       <h3>PaintBall</h3>
			      </div>
			    </div>
			      
			      
			    <div class="item">
			
			      <img src="/images/carousel/Jeux.jpg" alt="Baticraft">
			
			      <div class="carousel-caption">
			       <h3>Jeux</h3>
			      </div>
			    </div>
			    
			    
			    <div class="item">
			
			      <img src="/images/carousel/Arkendia.png" alt="Baticraft">
			
			      <div class="carousel-caption">
			       <h3>Arkendia</h3>
			      </div>
			    </div>
				
			
			      </div>
			
			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			  </a>
			</div>
	</div>
		
	
	
	<br><br>
	
		<!-- Ou copier le code ci-dessus dans les balises : -->
	<script type="text/javascript">
	sfHover = function() {
	        var sfEls = document.getElementById("menu").getElementsByTagName("LI");
	        for (var i=0; i<sfEls.length; i++) {
	                sfEls[i].onmouseover=function() {
	                        this.className+=" sfhover";
	                }
	                sfEls[i].onmouseout=function() {
	                        this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
	                }
	        }
	}
	if (window.attachEvent) window.attachEvent("onload", sfHover);
	</script>

<?php
}
?>	
	<div class="center">
		<div class="barreliens">
	
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
	
		</div>
	</div>
