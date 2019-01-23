<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
$bdd = new PDO("mysql:host=localhost", "root", "batinews");
$bdd->exec('USE Site');

?>

<head>
	
	<!-- Titre du Site -->

	    <title>Panel</title>
	
	<!-- meta -->

        <meta charset="utf-8" />
        <link rel="stylesheet" href="/css/style.css" />

</head>

<?php

if (isset($_COOKIE['membre_pseudo']) and isset($_COOKIE['membre_mdp']))
{
	if(!isset($_SESSION['membre_id']))
	{
		$result = $bdd->query("SELECT membre_id, membre_pseudo, membre_mdp, membre_grade, membre_banni FROM membres WHERE membre_pseudo = '".$_COOKIE['membre_pseudo']."'");
        $donnees = $result->fetch(PDO::FETCH_ASSOC);
				  if ($donnees['membre_banni'] == 0 AND $_COOKIE['membre_mdp'] == $donnees['membre_mdp'])
				  {
				        $_SESSION['membre_id'] = $donnees['membre_id'];
						$_SESSION['membre_pseudo'] = $donnees['membre_pseudo'];
						$_SESSION['membre_mdp'] = $donnees['membre_mdp'];
						$_SESSION['membre_grade'] = $donnees['membre_grade'];
                  }
        $result->closeCursor();
	}
	$bdd->query("UPDATE membres SET membre_derniere_visite='".time()."', membre_ip='" . $_SERVER['REMOTE_ADDR'] . "' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
}


if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 10)
{
?>
		<style>
		pre {
		overflow:auto;
		height:450px;
		background-color: black;
		color: white;
		width: 75%;
		text-align:left;
		}
		</style>
		<?php
		if(isset($_GET['id'])){
		$id = $_GET['id'];//on recup l'id dans url
		?>
		
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		
		<script>
		  $(function(){
		   setInterval(function(){
		            //var id = '<?php echo $id; ?>';
		            var id = '5';
		    $('#logs').load('log.php?id='+id);
		   }, 2000);
		  });
		 </script>
		
		<div id="logs">
			<?php include('log.php');?>
		</div>
		<div style="width : 25%;margin : auto;">
			<form method="GET" action="index.php">
				<select name="id">
				  <!--<option <?php if ($id == 0) { ?> selected="selected" <?php } ?> value="0">Baticraft</option>
				  <option <?php if ($id == 1) { ?> selected="selected" <?php } ?> value="1">Experimental</option>
				  <option <?php if ($id == 2) { ?> selected="selected" <?php } ?> value="2">FTB</option>
				  <option <?php if ($id == 3) { ?> selected="selected" <?php } ?> value="3">Hellstar</option>
				  <option <?php if ($id == 4) { ?> selected="selected" <?php } ?> value="4">Teamspeak3</option>-->
				  <option <?php if ($id == 5) { ?> selected="selected" <?php } ?> value="5">Ark Survival</option>
				</select>
				<div class="center"><input type="submit" class="btn1" value="Choisir serveur" /></div>
			</form>
			<form method="post" action="index-trait.php">
				<input type="hidden" name="type" value="cmd">
				<!--<input type="hidden" name="id" value="<?php echo $id; ?>">-->
				<input type="hidden" name="id" value="5">
				<label for="pseudo">Commande :</label>
				<input type="text" name="arg"/>
				<div class="center"><input type="submit" class="btn1" value="Envoyer" /></div>
			</form>
			
			
			
			<form method="post" action="index-trait.php">
				<input type="hidden" name="type" value="start">
				<input type="hidden" name="arg" value="">
				<!--<input type="hidden" name="id" value="<?php echo $id; ?>">-->
				<input type="hidden" name="id" value="5">
				<div class="center"><input type="submit" class="btn1" value="Démarer le serveur" /></div>
				</form>
				<form method="post" action="index-trait.php">
				<input type="hidden" name="type" value="stop">
				<input type="hidden" name="arg" value="">
				<!--<input type="hidden" name="id" value="<?php echo $id; ?>">-->
				<input type="hidden" name="id" value="5">
				<div class="center"><input type="submit" class="btn1" value="Arrêter le serveur" /></div>
			</form>
		
		</div>
			
		</div>
		<?php
		}else{
		?>
		<center><h1>Veuillez selectioner un serveur</h1>
		<form method="GET" action="index.php">
			<select name="id">
				  <!--<option value="0">Baticraft</option>
				  <option value="1">Experimental</option>
				  <option value="2">FTB</option>
				  <option value="3">Hellstar</option>
				  <option value="4">Teamspeak3</option>-->
				  <option value="5">Ark Survival</option>
			</select>
			<br><br>
			<div class="center"><input type="submit" class="btn1" value="Choisir serveur" /></div>
		</form>
		</center>
		<?php
		}
		?>
	
<?php
}
else
{
	header("Location: http://baticraft.tk/");
}
?>