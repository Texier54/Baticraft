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
include("../header.php");
    ?>
    <body>
  
<!-- Milieu -->

<?php
	$bdd->exec('USE forum');
	$sujet = $_GET['id'];
	
	if(isset($_POST['post']))
	{
		$bdd->query("INSERT INTO thread SET node_id='" . $_POST['thread_id'] . "', title='" . $_POST['titre'] . "', user_id='". $_SESSION['membre_id'] ."', username='" . $_SESSION['membre_pseudo'] . "', post_date='" . time() . "' ");
		$retour = $bdd->query("SELECT * FROM thread WHERE title='" . $_POST['titre'] . "' ");
		$donnees = $retour->fetch(PDO::FETCH_ASSOC);
			$bdd->query("INSERT INTO post SET thread_id='" . $donnees['id'] . "', user_id='". $_SESSION['membre_id'] ."', username='" . $_SESSION['membre_pseudo'] . "', post_date='" . time() . "', message='" .$_POST['message'] . "' ");
		$retour->closeCursor();
	}
?>

       	<header>
    		<div class="milieu">

				<a href="index.php"><p class="grostitre">Baticraft - Forum</p></a>

        		<div class=texte>
        			
        			<?php
        			
        				$retour = $bdd->query('SELECT * FROM sujets WHERE id=\'' . $sujet . '\' ');
						$donnees = $retour->fetch(PDO::FETCH_ASSOC);
						
						$nomsujet = $donnees['nom'];
						
						$retour->closeCursor();
        			
        			?>
        			
        			<h1><img src="images/projet.png" height="30"/> <?php echo $nomsujet; ?></h1>
        			
        			<a class="btn1" href="addthread.php?id=<?php echo $_GET['id']; ?>">Poster une nouvelle discussion</a><br><br>
        				
						<?php
							
							$retour = $bdd->query('SELECT * FROM thread WHERE node_id=\'' . $sujet . '\' ORDER by post_date DESC ');
							while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
							{
								$id = $donnees['id'];
								$nom = utf8_encode($donnees['title']);
								$pseudo = utf8_encode($donnees['username']);
								$date = $donnees['post_date'];
								?>
						
						
        						<div class="topic">
        							<?php
        								$bdd->exec('USE Site');
        								$retouravatar = $bdd->query('SELECT * FROM membres WHERE membre_pseudo=\'' . $pseudo . '\' ');
										$donneesavatar = $retouravatar->fetch(PDO::FETCH_ASSOC);
										
										$avatar = $donneesavatar['membre_avatar'];
										
        								$bdd->exec('USE forum');
        							?>
        							<img class="avatarfiche" src="../images/avatars/<?php echo $avatar ?>" height="40" width="40"/>
        							
        							<div class="infosavatar">
        								<a href="messages.php?id=<?php echo $id ?>&id_thread=<?php echo $_GET['id']; ?>" class="lienstopic"><?php echo $nom ?></a><br>
										<p class="infotopicavatar"><?php echo $pseudo ?>, <?php echo date(' j F Y', $date); ?></p>
									</div>
									<br>
        						</div>


					<?php
							}
							$retour->closeCursor();
					?>
		 
    			</div>
    			
				<br><br>

    		</div>

			
    	</header>



<?php 
include ("footer.php");
?>

</body>

</html>