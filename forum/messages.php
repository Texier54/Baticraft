<!DOCTYPE html>
    <?php
$titre_page = 'Baticraft - Forum';
$css = '<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="./minified/themes/default.min.css" type="text/css" />
';
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/modal.js"></script>
<script src="./minified/jquery.sceditor.bbcode.min.js"></script>
';

require ('../includes/fonctions.php');
$haut = 1;
include("../header.php");
    ?>
    <body>
		
<?php
function code($texte)
{
//Smileys
$texte = str_replace(':D ', '<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" />', $texte);
$texte = str_replace(':lol: ', '<img src="./images/smileys/lol.gif" title="lol" alt="lol" />', $texte);
$texte = str_replace(':triste:', '<img src="./images/smileys/triste.gif" title="triste" alt="triste" />', $texte);
$texte = str_replace(':frime:', '<img src="./images/smileys/cool.gif" title="cool" alt="cool" />', $texte);
$texte = str_replace(':rire:', '<img src="./images/smileys/rire.gif" title="rire" alt="rire" />', $texte);
$texte = str_replace(':s', '<img src="./images/smileys/confus.gif" title="confus" alt="confus" />', $texte);
$texte = str_replace(':O', '<img src="./images/smileys/choc.gif" title="choc" alt="choc" />', $texte);
$texte = str_replace(':question:', '<img src="./images/smileys/question.gif" title="?" alt="?" />', $texte);
$texte = str_replace(':exclamation:', '<img src="./images/smileys/exclamation.gif" title="!" alt="!" />', $texte);

//Mise en forme du texte
//gras
$texte = preg_replace('`\[B\](.+)\[/B\]`isU', '<strong>$1</strong>', $texte); 
//italique
$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
//souligné
$texte = preg_replace('`\[U\](.+)\[/U\]`isU', '<u>$1</u>', $texte);

//center
$texte = preg_replace('`\[CENTER\](.+)\[/CENTER\]`isU', '<center>$1</center>', $texte);

//taille
$texte = preg_replace('`\[SIZE=(.+)](.+)\[/SIZE]`isU', '<font size="$1;">$2</font>', $texte);

//couleur
$texte = preg_replace('`\[color=(.+)](.+)\[/color]`isU', '<span style="color: $1;">$2</span>', $texte);

//font
$texte = preg_replace('`\[FONT=(.+)](.+)\[/FONT]`isU', '<span style="font-family: $1;">$2</span>', $texte);

//image
$texte = preg_replace('`\[IMG\](.+)\[/IMG\]`isU', '<img width="50%" src="$1" />', $texte);

//RIGHT
$texte = preg_replace('`\[RIGHT\](.+)\[/RIGHT\]`isU', '<span style="float:right">$1</span>', $texte);

//LEFT
$texte = preg_replace('`\[LEFT\](.+)\[/LEFT\]`isU', '<span style="float:left">$1</span>', $texte);

//INDENT
$texte = preg_replace('`\[RIGHT\](.+)\[/RIGHT\]`isU', '<span style="float:right">$1</span>', $texte);

//image
$texte = preg_replace('`\[ATTACH=full](.+)\[/ATTACH]`isU', '<img width="50%" src="images/post/$1.data" />', $texte);

//lien
$texte = preg_replace('#https://[a-z0-9._/-]+#i', '<a href="$0" style="color:blue">$0</a>', $texte);

//lien
$texte = preg_replace('`\[url\](.+)\[/url\]`isU', '<a href="$1" style="color:blue">$1</a>', $texte);
//etc., etc.

//On retourne la variable texte
return $texte;
}
?>
  
  
<!-- Milieu -->

<?php
	$bdd->exec('USE forum');
	
	if(isset($_POST['message']))
	{
		$threadid = $_POST['threadid'];
		$user = $_POST['user'];
		$userid = $_POST['userid'];
		$message = $_POST['message'];

		
		$bdd->query("INSERT INTO post SET username='" . $user ."', thread_id='" . $threadid ."', user_id='" . $iduser . "', message='" . $message . "', post_date='" . time() . "' ");
	}
?>

       	<header>
    		<div class="milieu">

				<a href="index.php"><p class="grostitre">Baticraft - Forum</p></a>

        		<div class="texte">
        		
        			<?php
        			
        			$discussion = $_GET['id'];
        			
        			$retour = $bdd->query('SELECT * FROM thread WHERE id=\'' . $discussion . '\' ORDER by post_date DESC ');
					$donnees = $retour->fetch(PDO::FETCH_ASSOC);
					
					$nomdiscussion = utf8_encode($donnees['title']);
					
        			$retour->closeCursor();
        			?>
        			
        			<h1><img src="images/taverne.png" height="30"/><a style="color:white" href="discussions.php?id=<?php echo $_GET['id_thread']; ?>"> <?php echo $nomdiscussion ?></a></h1>
        				
						<?php

							
							$retour = $bdd->query('SELECT * FROM post WHERE thread_id=\'' . $discussion . '\' ');
							while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
							{
								$id = $donnees['id'];
								$pseudo = utf8_encode($donnees['username']);
								$message = utf8_encode(nl2br(stripslashes($donnees['message'])));
								$message = code(smiley($message));
								$date = $donnees['post_date'];
								
						?>
						
						
        						<div class="message">
        							<?php
        								$bdd->exec('USE Site');
        								$retouravatar = $bdd->query('SELECT * FROM membres WHERE membre_pseudo=\'' . $pseudo . '\' ');
										$donneesavatar = $retouravatar->fetch(PDO::FETCH_ASSOC);
										
										$avatar = $donneesavatar['membre_avatar'];
										
        								$bdd->exec('USE forum');
        							?>
        							<div class="image_post">
        								<img src="../images/avatars/<?php echo $avatar ?>" height="100" width="100"/><br>
        								<p style="font-size:14px"><?php echo $pseudo ?></p>
        							</div>
        							
        							<div class="message_post">
	        							<p class="messages"><?php echo $message  ?></p><br>
										<p class="infotopic"><?php echo $pseudo ?>, <?php echo date('d', $donnees['post_date']);
																    					$m = date('m', $donnees['post_date']);
																	      				if ($m == 01) {$mois = "janvier";}
																	      				elseif ($m == 02) {$mois = "février";}
																		  				elseif ($m == 03) {$mois = "mars";}
																		  				elseif ($m == 04) {$mois = "avril";}
																		  				elseif ($m == 05) {$mois = "mai";}
																		  				elseif ($m == 06) {$mois = "juin";}
																		  				elseif ($m == 07) {$mois = "juillet";}
																		  				elseif ($m >= 08 and $m <9) {$mois = "août";}
																		  				elseif ($m == 09) {$mois = "septembre";}
																		  				elseif ($m == 10) {$mois = "octobre";}
																		  				elseif ($m == 11) {$mois = "novembre";}
																		  				elseif ($m == 12) {$mois = "décembre";}
																		  				else {echo "erreur";}
																		  				echo ' '.$mois;
																    					echo ' '.date('Y', $donnees['post_date']);?>
	    								</p>
									</div>
        						</div>
        						
        						<div style="clear: both"></div>
        						
					<?php
							}
							$retour->closeCursor();
							
						if(isset($_SESSION['membre_id']))
						{
					?>
					
					<div class="message">
					
						<form method="POST">
						
        					<?php
        						$bdd->exec('USE Site');
        						$retouravatar = $bdd->query('SELECT * FROM membres WHERE membre_id=\'' . $_SESSION['membre_id'] . '\' ');
								$donneesavatar = $retouravatar->fetch(PDO::FETCH_ASSOC);
										
								$avatar = $donneesavatar['membre_avatar'];
										
        						$bdd->exec('USE forum');
        					?>
        					
							<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
							
							<img style="float: left; display:inline;" src="../images/avatars/<?php echo $avatar ?>" height="40" width="40"/>
							
							<input type="hidden" name="user" value="<?php echo $_SESSION['membre_pseudo'] ?>">
							
							<input type="hidden" name="userid" value="<?php echo $_SESSION['membre_id'] ?>">
							
							<input type="hidden" name="threadid" value="<?php echo $discussion ?>" />
							
							<div style="float: right; display:inline; width:96%;">
								<textarea  name="message" rows="20" style="width: 100%;"></textarea>
							</div>
							
							<div style="clear: both;"></div><br>
							
							<input value="Poster votre réponse" class="btn1" type="submit">
  						
						
						</form>
						
						<script>
							$(function() {
								var initEditor = function() {
									$('textarea').sceditor({
										plugins: 'bbcode',
										style: './minified/jquery.sceditor.default.min.css'
									});
								};
				
								$('#theme').change(function() {
									var theme = './minified/themes/' + $(this).val() + '.min.css';
				
									$('textarea').sceditor('instance').destroy();
									$('link:first').remove();
									$('#theme-style').remove();
				
									loadCSS(theme, initEditor);
								});
				
								initEditor();
							});
						</script>
					</div>
					<?php }
						else
							echo '<div style="float:right">Pour répondre vous devez vous connecter <a class="btn1" href="/connexion.php">Se connecter</a></div><br>'
						?>
					
					<br>
		 
    			</div>
    			
				<br><br><br>

    		</div>

			
    	</header>



<?php 
include ("footer.php");
?>

</div>

</body>

</html>