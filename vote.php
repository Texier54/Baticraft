<!DOCTYPE html>
    <?php
$titre_page = "Baticraft - Différents grades";
$css = '<link rel="stylesheet" href="css/style.css" />' ;
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/modal.js"></script>
<script src="/js/bootstrap.min.js"></script>';

$haut = 1;
include("header.php");
    ?>

<body>
	
	<br><br>
	
	<header>
	
		<div class="sommaire"> 
		<br><br>
		
<center>


<div class="titre">	
Votes 
</div>


<div class="sommairetext">
	<div class="center">
		<?php
			if(@$_GET['vote'] == 'try')
			{
				echo '<br><br><br><a class="button" href="?vote=ok">J\'ai voté !</a>';
			}
			elseif(@$_GET['vote'] == 'ok')
			{
				$is_valid_vote = file_get_contents('http://www.serveurs-minecraft.org/api/is_valid_vote.php?id=23474&ip='.$_SERVER['REMOTE_ADDR'].'&duration=5');
		  		if ($is_valid_vote > 0)
		  		{
		    		echo "<br><h2>Merci pour votre vote !</h2>";
		    		echo '<h1>Classement</h1>
					<table style="margin-left: auto; margin-right: auto; text-align: center; margin-top: -180px">
						<tr>
							<th>Pseudo</th><th>Votes</th>
						</tr>';
		    		$bdd->query("UPDATE membres SET membre_xp=membre_xp+20, membre_votes=membre_votes+1 WHERE membre_id='" . $_SESSION['membre_id'] . "'");

					$retour = $bdd->query('SELECT * FROM membres ORDER BY membre_votes DESC LIMIT 10');
					while ($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les news.
					{
					   	
						$pseudo = $donnees['membre_pseudo'];
						$votes = $donnees['membre_votes'];
						
						echo '<tr><td>'.$pseudo.'</td><td>'.$votes.'</td></tr><br>';

					} // Fin de la boucle qui liste les news.
					$retour->closeCursor();
					echo "</table><br>";
		  		}
		  		else if ($is_valid_vote == 0)
				  	echo "<br><h2>Il semblerait que vous n'ayez pas voté !</h2>";
			}
			else
			{
				?>
				<h1>Classement</h1>
					<table style="margin-left: auto; margin-right: auto; text-align: center; margin-top: -180px">
						<tr>
							<th>Pseudo</th><th>Votes</th>
						</tr>
				<?php
				$retour = $bdd->query('SELECT * FROM membres ORDER BY membre_votes DESC LIMIT 10');
				while ($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On fait une boucle pour lister les news.
				{
					   	
					$pseudo = $donnees['membre_pseudo'];
					$votes = $donnees['membre_votes'];
					
					?>
						<tr>
						<?php echo '<td>'.$pseudo.'</td><td>'.$votes.'</td><br>'; ?>
						<tr>
					<?php	
					   		   
				} // Fin de la boucle qui liste les news.
				$retour->closeCursor();
				?>
					<table>
				<?php
			}
			
			
			
			/*
							$is_valid_vote = file_get_contents('http://www.serveurs-minecraft.org/api/is_valid_vote.php?id=23474&ip=109.190.239.171&duration=5');
		  		if ($is_valid_vote > 0)
		    		echo "109.190.239.171 a voté pour le serveur durant les 5 dernières minutes";
		  		else if ($is_valid_vote == 0)
				  	echo "109.190.239.171 n'a pas voté pour le serveur durant les 5 dernières minutes";
				  	
			*/
		?>

<br><br><br>

	</div>
</div>

 </div>
 
 <br>
 
</center>

  </header>

<?php 
include ("footer.php"); 
?>

</body>
  
</html>


