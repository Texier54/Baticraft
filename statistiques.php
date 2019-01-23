<?php 
	session_start();
if($_SESSION['membre_grade'] >= 20)
{
	require("includes/database.php");
	$bdd->exec('USE Site');
		
		$year = date('y');
		$month = date('m');
		$day = date('d');
		
		$timestamp= mktime('00','00','00',$month,$day,$year);
		
		$retour_total = $bdd->query("SELECT COUNT(DISTINCT ip) AS total FROM stats WHERE date>= '".$timestamp."' "); //Nous récupérons le contenu de la requête dans $retour_total
		$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
		$total=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
			echo 'Total : '.$total.'<br><br>';
		$retour_total->closeCursor();
		
		$timestamp= mktime('00','00','00',$month,$day-30,$year);
		$timestampother = mktime('00','00','00',$month,$day-29,$year);
		
		$i=0;
		while($i<31)
		{
			$retour_total = $bdd->query("SELECT COUNT(DISTINCT ip) AS total FROM stats WHERE date>='".$timestamp."' and date<'".$timestampother."' "); //Nous récupérons le contenu de la requête dans $retour_total
			$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
			$totalcompte=$totalcompte.$donnees_total['total'].','; //On récupère le total pour le placer dans la variable $total.
			$datecompte=$datecompte.date('d',$timestamp).',';
			$retour_total->closeCursor();
			$i=$i+1;
			$timestamp= mktime('00','00','00',$month,$day+$i-30,$year);
			$timestampother= mktime('00','00','00',$month,$day+$i-29,$year);
		}
		
		?>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		
		<div id="container"></div>

		<script>
		Highcharts.chart('container', {
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Graphique visites'
		    },
		    subtitle: {
		        text: 'Texiervideos'
		    },
		    xAxis: {
		        categories: [<?php echo $datecompte ?>]
		    },
		    yAxis: {
		        title: {
		            text: 'Visites'
		        }
		    },
		    plotOptions: {
		        line: {
		            dataLabels: {
		                enabled: true
		            },
		            enableMouseTracking: false
		        }
		    },
		    series: [{
		        name: 'Visites',
		        data: [<?php echo $totalcompte ?>]
		    }]
		});
		</script>
		<br><br>
		
		<?php
		
		$timestamp= mktime('00','00','00',$month,$day,$year);
		
		$retour_total = $bdd->query("SELECT COUNT(DISTINCT ip) AS total FROM stats WHERE date>= '".$timestamp."' "); //Nous récupérons le contenu de la requête dans $retour_total
		$donnees_total = $retour_total->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
		$total=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
			echo 'Total : '.$total.'<br><br>';
		$retour_total->closeCursor();
		
		$retour = $bdd->query("SELECT * FROM stats WHERE date>= '".$timestamp."' ORDER BY date DESC ");
		while($donnees = $retour->fetch(PDO::FETCH_ASSOC)) // On lit les entrées une à une grâce à une boucle
		{
			if($donnees['ip'] == $_SERVER['REMOTE_ADDR'])echo '<font color="red">'.$donnees['ip'].'</font>'; else echo $donnees['ip']; echo ' &nbsp;&nbsp;&nbsp;&nbsp;'.date('d-m-y H\hi', $donnees['date']).' &nbsp;&nbsp;&nbsp;&nbsp;'.$donnees['page'];
			if($donnees['utilisateur'] != null)
			{
				$retourp = $bdd->query("SELECT membre_pseudo FROM membres WHERE membre_id= '". $donnees['utilisateur'] ."' ");
				$donneesp = $retourp->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
					echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$donneesp['membre_pseudo'];
				$retourp->closeCursor();
			}
			echo '<br>';
		}
		$retour->closeCursor();
}
?>