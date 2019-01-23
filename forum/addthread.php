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

//lien
$texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
//etc., etc.

//On retourne la variable texte
return $texte;
}
?>
  
  
<!-- Milieu -->

<?php
	$bdd->exec('USE forum');
	
	if(!isset($_SESSION['membre_id']))
	{
		header ("Refresh: 0;URL=/index.php");
	}
	else
	{
		
	
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
	
	        		<div class=texte>
	        		
	        			<?php
	        			
	        			$discussion = $_GET['id'];
	        			
	        			$retour = $bdd->query('SELECT * FROM thread WHERE id=\'' . $discussion . '\' ORDER by post_date DESC ');
						$donnees = $retour->fetch(PDO::FETCH_ASSOC);
						
						$nomdiscussion = utf8_encode($donnees['title']);
						
	        			$retour->closeCursor();
	        			?>
	        			
	        			<h1><img src="images/taverne.png" height="30"/> Créer la discussion</h1>
	        				
						<a class="btn1" href="discussions.php?id=<?php echo $_GET['id']; ?>">Retour</a><br><br>
						
							<form method="POST" action="discussions.php?id=<?php echo $_GET['id']; ?>">
							
	        					<?php
	        						$bdd->exec('USE Site');
	        						$retouravatar = $bdd->query('SELECT * FROM membres WHERE membre_id=\'' . $_SESSION['membre_id'] . '\' ');
									$donneesavatar = $retouravatar->fetch(PDO::FETCH_ASSOC);
											
									$avatar = $donneesavatar['membre_avatar'];
											
	        						$bdd->exec('USE forum');
	        					?>
	        					
								<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
															
								<input type="hidden" name="post" value="ok">
								
								<input type="hidden" name="thread_id" value="<?php echo $_GET['id']; ?>">
								
								<input type="text" name="titre" placeholder="Titre de la discussion..." size="40%" style="font-size:20px;"><br><br>
		
								<textarea id="textarea" contentEditable name="message" rows="20" cols="150"></textarea><br>
								
								<input value="Créer la discussion" class="btn1" type="submit">
								
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
							
							</form>
						
						<br>
			 
	    			</div>
	    			
					<br><br><br>
	
	    		</div>
	
				
	    	</header>
		
	<?php
	
	}
	?>


<?php 
include ("footer.php");
?>

</body>

</html>