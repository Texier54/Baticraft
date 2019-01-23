<!DOCTYPE html>
    <?php
$titre_page = 'Baticraft - Forum';
$css = '<link rel="stylesheet" href="css/style.css" />
';
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/modal.js"></script>
';

require ('../includes/fonctions.php');
$haut = 1;
require("../header.php");
    ?>
    <body>

<!-- Droite de page -->

		<div class="droite">

	        <br>
			 
			<!-- Connexion -->
			 
			<div class="titrecase">Profil</div>
			
			<?php
	
		   
			if(isset($_SESSION['membre_id']))
	        {
				$bdd->query("UPDATE membres SET membre_derniere_visite='".time()."' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
				$membres = $bdd->query('SELECT * FROM membres WHERE membre_id=\'' . $_SESSION['membre_id'] . '\'');
				$donnees = $membres->fetch(PDO::FETCH_ASSOC);
				
				$avatar = $donnees['membre_avatar'];
				$membres->closeCursor();
	          	?>
			  
			  	<div class="pseudo" ><div class="center">Bonjour, <br><?php echo $_SESSION['membre_pseudo']; ?> !</div></div>
			  	<a class="avatar2" href="membres/moncompte.php"><img src="../images/avatars/<?php echo $avatar; ?>" width="64" height="64" title="Changer l'avatar" /></a>
			  
			  	<h4>&nbsp;Statistiques du forum</h4>
			  
			  	<?php
			  	
			  		$bdd->exec('USE forum');
			  		
					$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM thread '); //Nous récupérons le contenu de la requête dans $retour_total1
			  		$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
					$total_discussions=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
			  	
					$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM post '); //Nous récupérons le contenu de la requête dans $retour_total1
			  		$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
					$total_messages=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
					
					$bdd->exec('USE Site');
					
					$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM membres '); //Nous récupérons le contenu de la requête dans $retour_total1
			  		$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
					$total_membres=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
					
					$bdd->exec('USE forum');
					
					echo '&nbsp;&nbsp;Discussions : '.$total_discussions.'<br>';
			  		echo '&nbsp;&nbsp;Messages : '.$total_messages.'<br>';
			  		echo '&nbsp;&nbsp;Membres : '.$total_membres.'<br>';
			  		
			  		$retour_total->closeCursor();
			  		
			  		$bdd->exec('USE Site');
			  	?>
			  
			<?php
	          
			}
			else
			{
			  	
			?>
	          
			  	<form name="connexion" id="connexion" method="post" action="/membres/connexion.php">
			  		<fieldset><legend>Connexion</legend>
						<label for="pseudo" class="float"></label> <input class="form-control" type="text" name="pseudo" id="pseudo" placeholder= "Pseudo" /><br>
						<label for="mdp" class="float"></label> <input class="form-control" type="password" name="mdp" id="mdp" placeholder= "Mot de Passe" /><br>
						<input type="hidden" name="validate" id="validate" value="ok"/>
						<input type="checkbox" name="cookie" id="cookie" checked="checked"/> <label for="cookie">Se souvenir de moi.</label><br>
						<input type="submit" class="btn1" value="Connexion" />
		       		</fieldset>
			   	</form>
			   	
			   	<fieldset><legend>Options</legend>
					<div class="center">
						<p><a class="Serveur2" href="../membres/inscription.php">Inscription !</a><br>
							<!-- <a class="d2" href="moncompte.php?action=reset">Mot de passe oublié!</a> -->
							<a class="Serveur2" href="../membres/forgot_mdp.php">Mot de passe oublié !</a>
						</p>
					</div>
			    </fieldset>
			   <?php
			   
			   }
			   
			   ?>

			  <br>
          </div>
  
  
<!-- Milieu -->

<?php
	$bdd->exec('USE forum');
?>
 
    		<div class="milieu_index">

				<a href="index.php"><p class="grostitre">Baticraft - Forum</p></a>

        		<div class=texte>
        		
        			<h1><img src="images/projet.png" height="30"/> Projets</h1>
        			
						<?php

							$categorie = '1';
							
							$retour = $bdd->query('SELECT * FROM sujets WHERE categorie=\'' . $categorie . '\' ');
							while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
							{
								$id = $donnees['id'];
								$nom = $donnees['nom'];
						?>
						
						
        						<div class="topic">
        							<a href="discussions.php?id=<?php echo $id ?>" class="lienstopic"><?php echo $nom ?></a><br>
							
									<?php
									
										$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM thread WHERE node_id=\'' . $id . '\' '); //Nous récupérons le contenu de la requête dans $retour_total1
										$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
										$totaldiscussions=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
										
										
										$retourdiscussions = $bdd->query('SELECT * FROM thread WHERE node_id=\'' . $id . '\' ');
										while($donneesdiscussions = $retourdiscussions->fetch(PDO::FETCH_ASSOC))
										{
											$iddiscussions = $donneesdiscussions['id'];
											$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM post WHERE thread_id=\'' . $iddiscussions. '\' '); //Nous récupérons le contenu de la requête dans $retour_total1
											$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
											$plusmessages=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.

											$totalmessages = $totalmessages + $plusmessages;
										}
										
		
										$retour_total->closeCursor();
									?>
							
        							<p class="infotopic">Discussions : <?php echo $totaldiscussions; ?> Messages : <?php echo $totalmessages; ?></p>
        						</div>
        						
					<?php
							}
							$totalmessages = 0;
					?>
					
        			
        			<h1><img src="images/taverne.png" height="30"/> Taverne de Baticraft</h1>
        				
						<?php
							$categorie = '2';
							
							$retour = $bdd->query('SELECT * FROM sujets WHERE categorie=\'' . $categorie . '\' ');
							while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
							{
								$id = $donnees['id'];
								$nom = $donnees['nom'];
						?>
						
						
        						<div class="topic">
        							<a href="discussions.php?id=<?php echo $id ?>" class="lienstopic"><?php echo $nom ?></a><br>
							
									<?php
									
										$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM thread WHERE node_id=\'' . $id . '\' '); //Nous récupérons le contenu de la requête dans $retour_total1
										$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
										$totaldiscussions=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
										
										$retourdiscussions = $bdd->query('SELECT * FROM thread WHERE node_id=\'' . $id . '\' ');
										while($donneesdiscussions = $retourdiscussions->fetch(PDO::FETCH_ASSOC))
										{
											$iddiscussions = $donneesdiscussions['id'];
	
											$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM post WHERE thread_id=\'' . $iddiscussions. '\' '); //Nous récupérons le contenu de la requête dans $retour_total1
											$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
											$plusmessages=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
											
											$totalmessages = $totalmessages + $plusmessages;
											
										}
										
										
										$retour_total->closeCursor();
									?>
							
        							<p class="infotopic">Discussions : <?php echo $totaldiscussions; ?> Messages : <?php echo $totalmessages; ?></p>
        						</div>
      

					<?php
							}
							$totalmessages = 0;
					?>

        				
        				
        			<h1><img src="images/divers.png" height="30"/> Divers</h1>
						
						<?php
							$categorie = '3';
							
							$retour = $bdd->query('SELECT * FROM sujets WHERE categorie=\'' . $categorie . '\' ');
							while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
							{
								$id = $donnees['id'];
								$nom = $donnees['nom'];
						?>
						
						
        						<div class="topic">
        							<a href="discussions.php?id=<?php echo $id ?>" class="lienstopic"><?php echo $nom ?></a><br>
							
									<?php
									
										$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM thread WHERE node_id=\'' . $id . '\' '); //Nous récupérons le contenu de la requête dans $retour_total1
										$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
										$totaldiscussions=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
					
										$retourdiscussions = $bdd->query('SELECT * FROM thread WHERE node_id=\'' . $id . '\' ');
										while($donneesdiscussions = $retourdiscussions->fetch(PDO::FETCH_ASSOC))
										{
											$iddiscussions = $donneesdiscussions['id'];
	
											$retour_total=$bdd->query('SELECT COUNT(*) AS total FROM post WHERE thread_id=\'' . $iddiscussions. '\' '); //Nous récupérons le contenu de la requête dans $retour_total1
											$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
											$plusmessages=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
											
											$totalmessages = $totalmessages + $plusmessages;
											
										}
										
		
										$retour_total->closeCursor();
									?>
							
        							<p class="infotopic">Discussions : <?php echo $totaldiscussions; ?> Messages : <?php echo $totalmessages; ?></p>
        						</div>
        						
					<?php
							}
							$totalmessages = 0;
							$retour->closeCursor();
					?>
					
		 
    			</div>
    			
				<br>

    		</div>

<?php 
include ("footer.php");
?>

</body>

</html>