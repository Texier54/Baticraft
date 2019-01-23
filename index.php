<!DOCTYPE html>
    <?php
$titre_page = 'Serveur Minecraft | Baticraft.tk';
$css = '<link rel="stylesheet" href="css/style.css" />
';
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/modal.js"></script>
<script src="/js/bootstrap.min.js"></script>
';

require ('includes/fonctions.php');
include("header.php");
    ?>
    
	<body>

<!-- &nbsp; -->

	<div class="center">

		<!-- Gauche de page -->

		<div class="gauche">
			<div class="boite">
				<div class="titrecase">Statut</div>
				<div class="boiteinterieur">
		
					<!-- Code PHP En ligne -->
					<div id="noir"> 
						<?php
	          			define( 'MQ_SERVER_ADDR', 'baticraft.tk' );
	          			define( 'MQ_SERVER_PORT', 27286 );
	          			define( 'MQ_TIMEOUT', 1 );
	
						require __DIR__ . '/serveur/MinecraftQuery.class.php';
	
						$Query = new MinecraftQuery( );
	
	        			try
						{
			  				$Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
						}
						catch( MinecraftQueryException $e )
						{
							$Error = $e->getMessage( );
						}
	   
						if(isset($Error)){
	          				echo '<span class="Serveur" style="color:red;">Serveur Off</span><br>';//<span class="Serveur" style="color:red;">Serveur Off</span><br>';
	          			}else
	          			{
	          				echo '<span class="Serveur">Serveur</span> <span style="color:#12B525;">On</span><br>';
			  
	        				if(($Info = $Query->GetInfo( )) != false)
	        				{
	
	        					// echo $Info ['Players'];
	        					// echo '/';  
	        					// echo $Info ['MaxPlayers'];
	       						?>
	       						<span class="Serveur">Version : <?php echo $Info['Version'];?></span>
	       						<?php
	         				}
	        			}
	       				?>
	       				
					</div>
					<a class="Serveur"> IP : Baticraft.tk </a><br>
				</div>
        	</div>
        
        	<div class="boite">
        		<div class="titrecase">Serveur</div>
        		<div class="boiteinterieur">
			        <a class="Serveur" href="regles.php"> Règles du Serveur</a><br>
			        <a class="Serveur" href="FAQ.php"> F.A.Q</a><br>
			        <a class="Serveur" href="grade.php"> Différents grades</a><br>
        			<a class="Serveur" href="informations.php">Informations à savoir</a><br>
        		</div>
        	</div>
        
        	<div class="boite">
        		<div class="titrecase">Fan-Art</div>
				<div class="boiteinterieur">
					<a class="Serveur" href="album/album.php">Vos screenshots</a><br>
        			<a class="Serveur" href="fan.php">Section Dessins</a><br>
				</div>
			</div>

        	<div class="boite">
        		<div class="titrecase">Présentation</div>
        		<div class="boiteinterieur">
        			<a class="Serveur" href="roleplay.php">RolePlay</a>
        		</div>
        	</div>
			
			        <script type="text/javascript">
		<!--
			function open_infos()
			{
				width = 900;
				height = 600;
				if(window.innerWidth)
				{
					var left = (window.innerWidth-width)/2;
					var top = (window.innerHeight-height)/2;
				}
				else
				{
					var left = (document.body.clientWidth-width)/2;
					var top = (document.body.clientHeight-height)/2;
				}
				document.location.href="vote.php?vote=try"; 
				window.open('http://www.serveurs-minecraft.org/vote.php?id=23474','nom_de_ma_popup','menubar=no, scrollbars=no, top='+top+', left='+left+', width='+width+', height='+height+'');
			}
		-->
		</script>
		
			<div class="boite">
        		<div class="titrecase">Top-serveur</div>
        		<div class="boiteinterieur"> 
        			<a class="Serveur" onclick="javascript:open_infos();" href="http://www.serveurs-minecraft.org/vote.php?id=23474" target="_blank">Voter pour Baticraft</a> <br><a class="Serveur" href="http://www.serveurs-minecraft.org/" target="_blank">Serveurs-minecraft.org</a><br>
        			<a class="Serveur" href="http://www.mcserv.org/Baticraft_5750.html" target="_blank">Votez pour Baticraft</a> <br><a class="Serveur" href="http://www.mcserv.org/" target="_blank">McServ.org</a><br>
        			<a class="Serveur" href="http://www.serveur-minecraft.eu/" target="_blank">Serveur-minecraft.eu</a>
				</div>
			</div>
            
    		<div class="boite">
        		<div class="titrecase">Youtube</div>
        		<div class="boiteinterieur">
        			<script src="https://apis.google.com/js/plusone.js"></script>
        			<div class="g-ytsubscribe" data-channel="texier54" data-layout="full"></div>
       			</div>
       		</div>

        	<div class="boite">
        		<div class="titrecase">Equipe</div>
        		<div class="boiteinterieur">
        			<a class="Serveur" href="https://twitter.com/Texier54" target="_blank">Texier54</a><br>
        			<a class="Serveur" href="https://twitter.com/Be_Raph" target="_blank">Slenderstar</a><br>
        			<a class="Serveur" href="https://twitter.com/Bokopii" target="_blank">Bokopi</a><br>
				</div>
			</div>
		
			<br>

		</div>
		
<!-- Milieu -->

    	<div class="introduction">

	        <p class="minecraft">News du serveur :</p>
	
		<script> $('.collapse').collapse()</script>
			
			<script>
			  $(function () {
			    $('#myTab a:last').tab('show')
			  })
			</script>
	
		<!-- Nav tabs -->
		<div class="news">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#1" data-toggle="tab">
		        <?php $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 0, 1');
		        $donnees = $retour->fetch(PDO::FETCH_ASSOC);echo date('d/m/Y à H\hi', $donnees['timestamp']); 
		        $retour->closeCursor();?>
		  </a></li>
		  <li><a href="#2" data-toggle="tab">
				<?php $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 1, 1');
		        $donnees = $retour->fetch(PDO::FETCH_ASSOC);echo date('d/m/Y à H\hi', $donnees['timestamp']);
		        $retour->closeCursor();?>
		  </a></li>
		  <li><a href="#3" data-toggle="tab">
		        <?php $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 2, 1');
		        $donnees = $retour->fetch(PDO::FETCH_ASSOC);echo date('d/m/Y à H\hi', $donnees['timestamp']);
		        $retour->closeCursor();?>
		  </a></li>
		  <li><a href="#4" data-toggle="tab">
		        <?php $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 3, 1');
		        $donnees = $retour->fetch(PDO::FETCH_ASSOC);echo date('d/m/Y à H\hi', $donnees['timestamp']); 
		        $retour->closeCursor();?>
		  </a></li>
		</ul>
		
		<!-- Tab panes -->
		</div>
	
	<br>
	        <div class=texte>
	
	        <div class="center">
	
			<br>
	         
	            
	<div class="tab-content">
	  <div class="tab-pane active" id="1">
	<?php
	    // On récupère la dernière dernières news.
		$retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 0, 1');
		$donnees = $retour->fetch(PDO::FETCH_ASSOC);
		
	    ?>
	
	
	        <div class="titre_milieu">
	        <?php echo $donnees['titre']; ?>
	        </div>
	      
	        <a class="bouton_news" href="news/news.php"><span class="glyphicon glyphicon-edit"></span></a>
	      
	     <!--734 432-->
	         <br>
	
	            <a href="#" data-modal-id="modal1" onclick="image('img1')">
					<img title="<?php echo $donnees['titre']; ?>" width="734" height="430" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" />
	            </a>
	
			
			<div id="modal1" class="modal-box">
	  			<div class="entete">
	    			<h4><?php echo $donnees['titre']; ?></h4>
	  			</div>
				<div class="center"><img title="<?php echo $donnees['titre']; ?>" width="100%" id="img1" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" /></div><br>
	  			<a class="btn btn-small" href="#2" data-toggle="tab" data-modal-id-2="modal2" onclick="image('img2');">Précédent</a>
					<footer> 
	  					<div class="news">
	    					<?php echo date('d', $donnees['timestamp']);
	    					$m = date('m', $donnees['timestamp']);
		      				if ($m == '01') {$mois = "janvier";}
		      				elseif ($m == '02') {$mois = "février";}
			  				elseif ($m == '03') {$mois = "mars";}
			  				elseif ($m == '04') {$mois = "avril";}
			  				elseif ($m == '05') {$mois = "mai";}
			  				elseif ($m == '06') {$mois = "juin";}
			  				elseif ($m == '07') {$mois = "juillet";}
			  				elseif ($m == '08') {$mois = "août";}
			  				elseif ($m == '09') {$mois = "septembre";}
			  				elseif ($m == '10') {$mois = "octobre";}
			  				elseif ($m == '11') {$mois = "novembre";}
			  				elseif ($m == '12') {$mois = "décembre";}
			  				else {echo "erreur";}
			  				echo ' '.$mois;
	    					echo ' '.date('Y', $donnees['timestamp']);?>
		      				| Catégorie : 
							<?php echo $donnees['sous_titre']; ?><br><br>
	    					<?php
	    					// On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    					$contenu = nl2br(stripslashes($donnees['contenu']));
	    					$contenu = urlsmiley($contenu);
							 echo $contenu; ?>
	    				</div>
	  					<a class="btn btn-small js-modal-close">Fermer</a> 
	  				</footer>
	  				<br>
			</div>
			
			
	         <br><br>
			 <div class="news">
	
	
	    <?php echo date('d', $donnees['timestamp']);
	    $m = date('m', $donnees['timestamp']);
		      if ($m == '01') {$mois = "janvier";}
		      elseif ($m == '02') {$mois = "février";}
			  elseif ($m == '03') {$mois = "mars";}
			  elseif ($m == '04') {$mois = "avril";}
			  elseif ($m == '05') {$mois = "mai";}
			  elseif ($m == '06') {$mois = "juin";}
			  elseif ($m == '07') {$mois = "juillet";}
			  elseif ($m == '08') {$mois = "août";}
			  elseif ($m == '09') {$mois = "septembre";}
			  elseif ($m == '10') {$mois = "octobre";}
			  elseif ($m == '11') {$mois = "novembre";}
			  elseif ($m == '12') {$mois = "décembre";}
			  else {echo "erreur";}
			  echo ' '.$mois;
	          echo ' '.date('Y', $donnees['timestamp']);?>
		      | Catégorie : 
		<?php echo $donnees['sous_titre']; ?><br><br>
	    <?php
	    // On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    $contenu = nl2br(stripslashes($donnees['contenu']));
	    $contenu = urlsmiley($contenu);
	    echo $contenu;
	    $retour->closeCursor();
	?>
	 
	    </div>
	</div>
	  <div class="tab-pane" id="2">
	  <?php
	  
	  
	    // On récupère la dernière dernières news.
	    $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 1, 1');
	    $donnees = $retour->fetch(PDO::FETCH_ASSOC);
	    ?>
	
	
	        <div class="titre_milieu">
	        <?php echo $donnees['titre']; ?>
	        </div>
	      
			<a class="bouton_news" href="news/news.php"><span class="glyphicon glyphicon-edit"></span></a>
	
	     <!--734 432-->
	
	         <br>
	
	            <a href="#" data-modal-id="modal2" onclick="image('img2')">
					<img title="<?php echo $donnees['titre']; ?>" width="734" height="430" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" />
	            </a>
	            
			<div id="modal2" class="modal-box">
	  			<div class="entete">
	    			<h4><?php echo $donnees['titre']; ?></h4>
	  			</div>
				<div class="center"><img title="<?php echo $donnees['titre']; ?>" width="100%" id="img2" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" /></div><br>
	  				<a class="btn btn-small" href="#1" data-toggle="tab" data-modal-id-2="modal1" onclick="image('img1');">Suivant</a> 
	  			<a class="btn btn-small" href="#3" data-toggle="tab" data-modal-id-2="modal3" onclick="image('img3');">Précédent</a>
					<footer> 
	  					<div class="news">
	    					<?php echo date('d', $donnees['timestamp']);
	    					$m = date('n', $donnees['timestamp']);
		      				if ($m ==1) {$mois = "janvier";}
		      				elseif ($m == 2) {$mois = "février";}
			  				elseif ($m == 3) {$mois = "mars";}
			  				elseif ($m == 4) {$mois = "avril";}
			  				elseif ($m == 5) {$mois = "mai";}
			  				elseif ($m == 6) {$mois = "juin";}
			  				elseif ($m == 7) {$mois = "juillet";}
							elseif ($m == 8) {$mois = "août";}
							elseif ($m == 9) {$mois = "septembre";}
			  				elseif ($m == 10) {$mois = "octobre";}
			  				elseif ($m == 11) {$mois = "novembre";}
			  				elseif ($m == 12) {$mois = "décembre";}
			  				else {echo "erreur";}
			  				echo ' '.$mois;
	    					echo ' '.date('Y', $donnees['timestamp']);?>
		      				| Catégorie : 
							<?php echo $donnees['sous_titre']; ?><br><br>
	    					<?php
	    					// On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    					$contenu = nl2br(stripslashes($donnees['contenu']));
	    					$contenu = urlsmiley($contenu);
							 echo $contenu; ?>
	    				</div>
	  					<a class="btn btn-small js-modal-close">Fermer</a>
	  				</footer>
	  				<br>
			</div>
	
			
	         <br><br>
			 <div class="news">
	
	
	    <?php echo date('d', $donnees['timestamp']);
	    $m = date('n', $donnees['timestamp']);
		      if ($m == 1) {$mois = "janvier";}
		      elseif ($m == 2) {$mois = "février";}
			  elseif ($m == 3) {$mois = "mars";}
			  elseif ($m == 4) {$mois = "avril";}
			  elseif ($m == 5) {$mois = "mai";}
			  elseif ($m == 6) {$mois = "juin";}
			  elseif ($m == 7) {$mois = "juillet";}
			  elseif ($m == 8) {$mois = "août";}
			  elseif ($m == 9) {$mois = "septembre";}
			  elseif ($m == 10) {$mois = "octobre";}
			  elseif ($m == 11) {$mois = "novembre";}
			  elseif ($m == 12) {$mois = "décembre";}
			  else {echo "erreur";}
			  echo ' '.$mois;
	    	  echo ' '.date('Y', $donnees['timestamp']);?>
		      | Catégorie : 
		<?php echo $donnees['sous_titre']; ?><br><br>
	    <?php
	    // On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    $contenu = nl2br(stripslashes($donnees['contenu']));
	    $contenu = urlsmiley($contenu);
	    echo $contenu;
		$retour->closeCursor();
	?>
	 
	    </div>
	  </div>
	  <div class="tab-pane" id="3">
	  <?php
	// On récupère la dernière dernières news.
	    $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 2, 1');
	    $donnees = $retour->fetch(PDO::FETCH_ASSOC);
	    ?>
	
	
	        <div class="titre_milieu">
	        <?php echo $donnees['titre']; ?>
	        </div>
	      
			<a class="bouton_news" href="news/news.php"><span class="glyphicon glyphicon-edit"></span></a>
	
	     <!--734 432-->
	
	         <br>
	
	            <a href="#" data-modal-id="modal3" onclick="image('img3')">
					<img title="<?php echo $donnees['titre']; ?>" width="734" height="430" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" />
	            </a>
	            
			<div id="modal3" class="modal-box">
	  			<div class="entete">
	    			<h4><?php echo $donnees['titre']; ?></h4>
	  			</div>
				<div class="center"><img title="<?php echo $donnees['titre']; ?>" width="100%" id="img3" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" /></div><br>
	  				<a class="btn btn-small" href="#2" data-toggle="tab" data-modal-id-2="modal2" onclick="image('img2');">Suivant</a> 
	  			<a class="btn btn-small" href="#4" data-toggle="tab" data-modal-id-2="modal4" onclick="image('img4');">Précédent</a>
					<footer> 
	  					<div class="news">
	    					<?php echo date('d', $donnees['timestamp']);
	    					$m = date('n', $donnees['timestamp']);
		      				if ($m == 1) {$mois = "janvier";}
		      				elseif ($m == 2) {$mois = "février";}
			  				elseif ($m == 3) {$mois = "mars";}
			  				elseif ($m == 4) {$mois = "avril";}
			  				elseif ($m == 5) {$mois = "mai";}
			  				elseif ($m == 6) {$mois = "juin";}
			  				elseif ($m == 7) {$mois = "juillet";}
			  				elseif ($m == 8) {$mois = "août";}
			  				elseif ($m == 9) {$mois = "septembre";}
			  				elseif ($m == 10) {$mois = "octobre";}
			  				elseif ($m == 11) {$mois = "novembre";}
			  				elseif ($m == 12) {$mois = "décembre";}
			  				else {echo "erreur";}
			  				echo ' '.$mois;
	    					echo ' '.date('Y', $donnees['timestamp']);?>
		      				| Catégorie : 
							<?php echo $donnees['sous_titre']; ?><br><br>
	    					<?php
	    					// On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    					$contenu = nl2br(stripslashes($donnees['contenu']));
	    					$contenu = urlsmiley($contenu);
							 echo $contenu; ?>
	    				</div>
	  					<a class="btn btn-small js-modal-close">Fermer</a> 
	  				</footer>
	  				<br>
			</div>
			
	         <br><br>
			 <div class="news">
	
	
	    <?php echo date('d', $donnees['timestamp']);
	    $m = date('n', $donnees['timestamp']);
		      if ($m == 1) {$mois = "janvier";}
		      elseif ($m == 2) {$mois = "février";}
			  elseif ($m == 3) {$mois = "mars";}
			  elseif ($m == 4) {$mois = "avril";}
			  elseif ($m == 5) {$mois = "mai";}
			  elseif ($m == 6) {$mois = "juin";}
			  elseif ($m == 7) {$mois = "juillet";}
			  elseif ($m == 8) {$mois = "août";}
			  elseif ($m == 9) {$mois = "septembre";}
			  elseif ($m == 10) {$mois = "octobre";}
			  elseif ($m == 11) {$mois = "novembre";}
			  elseif ($m == 12) {$mois = "décembre";}
			  else {echo "erreur";}
			  echo ' '.$mois;
	    	  echo ' '.date('Y', $donnees['timestamp']);?>
		      | Catégorie : 
		<?php echo $donnees['sous_titre']; ?><br><br>
	    <?php
	    // On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    $contenu = nl2br(stripslashes($donnees['contenu']));
	    $contenu = urlsmiley($contenu);
	    echo $contenu;
		$retour->closeCursor();
	?>
	 
	    </div>
	  </div>
	  <div class="tab-pane" id="4">
	  <?php
	    // On récupère la dernière dernières news.
	    $retour = $bdd->query('SELECT * FROM news ORDER BY id DESC LIMIT 3, 1');
	    $donnees = $retour->fetch(PDO::FETCH_ASSOC);
	    ?>
	
	
	        <div class="titre_milieu">
	        <?php echo $donnees['titre']; ?>
	        </div>
	      
			<a class="bouton_news" href="news/news.php"><span class="glyphicon glyphicon-edit"></span></a>
	
	     <!--734 432-->
	
	         <br>
	
	            <a href="#" data-modal-id="modal4" onclick="image('img4')">
					<img title="<?php echo $donnees['titre']; ?>" width="734" height="430" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" />
	            </a>
	
			<div id="modal4" class="modal-box">
	  			<div class="entete">
	    			<h4><?php echo $donnees['titre']; ?></h4>
	  			</div>
				<div class="center"><img title="<?php echo $donnees['titre']; ?>" width="100%" id="img4" src="images/news/little/<?php echo $donnees['image']; ?>" alt="" /></div><br>
	  				<a class="btn btn-small" href="#3" data-toggle="tab" data-modal-id-2="modal3" onclick="image('img3');">Suivant</a> 
					<footer> 
	  					<div class="news">
	    					<?php echo date('d', $donnees['timestamp']);
	    					$m = date('n', $donnees['timestamp']);
		      				if ($m == 1) {$mois = "janvier";}
		      				elseif ($m == 2) {$mois = "février";}
			  				elseif ($m == 3) {$mois = "mars";}
			  				elseif ($m == 4) {$mois = "avril";}
			  				elseif ($m == 5) {$mois = "mai";}
			  				elseif ($m == 6) {$mois = "juin";}
			  				elseif ($m == 7) {$mois = "juillet";}
			  				elseif ($m == 8) {$mois = "août";}
			  				elseif ($m == 9) {$mois = "septembre";}
			  				elseif ($m == 10) {$mois = "octobre";}
			  				elseif ($m == 11) {$mois = "novembre";}
			  				elseif ($m == 12) {$mois = "décembre";}
			  				else {echo "erreur";}
			  				echo ' '.$mois;
	    					echo ' '.date('Y', $donnees['timestamp']);?>
		      				| Catégorie : 
							<?php echo $donnees['sous_titre']; ?><br><br>
	    					<?php
	    					// On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    					$contenu = nl2br(stripslashes($donnees['contenu']));
	    					$contenu = urlsmiley($contenu);
							 echo $contenu; ?>
	    				</div>
	  					<a class="btn btn-small js-modal-close">Fermer</a> 
	  				</footer>
	  				<br>
			</div>
			
	         <br><br>
			 <div class="news">
	
	
	    <?php echo date('d', $donnees['timestamp']);
	    $m = date('m', $donnees['timestamp']);
		      if ($m == 1) {$mois = "janvier";}
		      elseif ($m == 2) {$mois = "février";}
			  elseif ($m == 3) {$mois = "mars";}
			  elseif ($m == 4) {$mois = "avril";}
			  elseif ($m == 5) {$mois = "mai";}
			  elseif ($m == 6) {$mois = "juin";}
			  elseif ($m == 7) {$mois = "juillet";}
			  elseif ($m == 8) {$mois = "août";}
			  elseif ($m == 9) {$mois = "septembre";}
			  elseif ($m == 10) {$mois = "octobre";}
			  elseif ($m == 11) {$mois = "novembre";}
			  elseif ($m == 12) {$mois = "décembre";}
			  else {echo "erreur";}
			  echo ' '.$mois;
			  echo ' '.date('Y', $donnees['timestamp']);?>
		      | Catégorie : 
		<?php echo $donnees['sous_titre']; ?><br><br>
	    <?php
	    // On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br>).
	    $contenu = nl2br(stripslashes($donnees['contenu']));
	    $contenu = urlsmiley($contenu);
	    echo $contenu;
		$retour->closeCursor();
	?>
	 
	    </div>
	  </div>
	</div>
	         <br><br>
	
	
	    <div class="titre_milieu">
	       SLRDB Arkendia
	    </div>
		
	         <br>
			 
	    </div>
	
	        <iframe class="videoaccueil" src="https://www.youtube.com/embed/zZBnsbU-Ah8"></iframe>
	
	    <div class="news">
	
	         <br>
	
	        18 juin 2014 | Catégorie: Youtube<br><br>
	
	    </div>
	         <br><br>
			 
	    </div>
	         <br>

    	</div> <!-- Fin introduction -->
    	
<!-- Droite de page -->

		<div class="droite">

			<!-- Connexion -->
		 
			<!-- <img src="images/<?php $connexion = 'connexion.png'; $profil = 'profil.png'; if(isset($_SESSION['membre_id'])) { echo $profil; } else { echo $connexion; }?> " height="30" alt="banniere du serveur" title="Serveur Baticraft !" />
			-->
			
			<div class="boite">
			
				<div class="titrecase">Profil</div>
			
				<div class="boiteinterieur">
			
					<?php
			
				   
					if(isset($_SESSION['membre_id']))
					{
						$bdd->query("UPDATE membres SET membre_derniere_visite='".time()."' WHERE membre_id='" . $_SESSION['membre_id'] . "'");
						$membres = $bdd->query('SELECT * FROM membres WHERE membre_id=\'' . $_SESSION['membre_id'] . '\'');
						$donnees = $membres->fetch(PDO::FETCH_ASSOC);
						
						$avatar = $donnees['membre_avatar'];
						$membres->closeCursor();
			          	?>
					  
					  	<div class="pseudo" >Bonjour, <br><?php echo $_SESSION['membre_pseudo']; ?> !</div>
					  	<a class="avatar" href="" data-modal-id="profil"><img src="images/avatars/<?php echo $avatar; ?>" width="64" height="64" title="Changer l'avatar" /></a>
					  	Niveau: <span style="border-radius: 200%; border: solid black 3px; padding: 0.5px 4px 0.5px 4px;"><?php echo $level; ?></span><br><br>
						<progress max="100" value="<?php echo ($xp*100)/(100*pow(1.2,$level-1)) ?>" form="form-id"><?php echo ($xp*100)/(100*pow(1.2,$level-1)) ?></progress><br>
						<div class="center"><?php echo $xp.'/'.$xplevel; ?></div>
					  	
					  	<a class="Serveur" href="membres/profil.php">Profil</a><br>
					  	<a class="Serveur" href="membres/classement.php">Classement</a><br>
					  	<a class="Serveur" href="membres/liste_membres.php">Liste des membres</a><br>
					  		
			          	<?php
					}
					else
					{
			          	?>
					  	<form name="connexion" id="connexion" method="post" action="/membres/connexion.php">
					  		<fieldset><legend>Connexion</legend>
								<input class="form-control" type="text" name="pseudo" id="pseudo" placeholder= "Pseudo" /><br>
								<input class="form-control" type="password" name="mdp" id="mdp" placeholder= "Mot de Passe" /><br>
								<input type="hidden" name="validate" id="validate" value="ok"/>
								<input type="checkbox" name="cookie" id="cookie" checked="checked"/> <label for="cookie">Se souvenir de moi.</label><br>
								<input type="submit" class="btn1" value="Connexion" />
				       		</fieldset>
					   	</form>
					   		
					   	<fieldset><legend>Options</legend>
							<div class="center">
								<p><a class="Serveur" href="membres/inscription.php">Inscription !</a><br>
									<!-- <a class="d2" href="moncompte.php?action=reset">Mot de passe oublié!</a> -->
									<a class="Serveur" href="membres/forgot_mdp.php">Mot de passe oublié !</a>
								</p>
							</div>
					    </fieldset>
					   	<?php
					}
						?>
		   
				</div>
		   
		   	</div>
		   

	 
			<!-- Teamspeak -->
          
			<div class="boite">
          
	          	<div class="titrecase">Teamspeak 3</div>
				
			  	<div class="boiteinterieur">	
				
					<a class="Serveur" href="ts3server://baticraft.tk">TeamSpeak 3</a><br>
			  
			  	</div>
		  
			</div>
		  

			
        	<div class="boite">
        
        		<div class="titrecase">Réseaux sociaux</div>
        
        		<div class="boiteinterieur">

        			<a class="liensociaux" href="https://twitter.com/baticraftserv" target="_blank"><img  src="images/twitter.png" alt="Twitter" title="Twitter" /></a>

        			<a href="http://www.facebook.com/Baticraft.fr?ref=hl" target="_blank"><img  src="images/facebook.png" alt="Facebook" title="Facebook" /></a>

					<br>
		
				</div>
		
			</div>
		

			
			<!-- Twitter -->
			
			<div class="titrecase">Twitter</div>
			
			<a class="twitter-timeline" data-height="600" href="https://twitter.com/baticraftserv?ref_src=twsrc%5Etfw">Tweets by baticraftserv</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		 
		  
		</div>
		
	</div>

<?php include_once("analyticstracking.php") ?>
        <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         ga('create', 'UA-45734600-1', 'baticraft.tk');
         ga('send', 'pageview');
        </script>

<?php 
	include ("footer.php");
?>

</body>

</div>

</html>