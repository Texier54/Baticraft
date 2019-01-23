<?php

	//--------------------------------------------------------------------------
	//			CONNEXION AU RCON POUR ENVOYER DES COMMANDES AU SERVEUR
	//--------------------------------------------------------------------------
	require_once('Rcon.class.php'); 

	$r = new rcon("127.0.0.1",27287,"bati48621"); // Remplacer l'ip, le port et le mot de passe par les votres

	if(isset($_POST['submit'])){

		$command = $_POST['command'];

			if($r->Auth())
			{
			$r->rconCommand($command);
			}
	}

	//--------------------------------------------------------------------------
	//		CONNEXION AU QUERY POUR RECEVOIR DES INFORMATIONS DE VOTRE SERVEUR
	//--------------------------------------------------------------------------

	define( 'MQ_SERVER_ADDR', '127.0.0.1' ); // Remplacer l'ip par la votre
	define( 'MQ_SERVER_PORT', 27286 ); // Remplacer le port par le votre
	define( 'MQ_TIMEOUT', 1 );

	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );

	require __DIR__ . '/MinecraftQuery.class.php';

	$Timer = MicroTime( true );
	$Query = new MinecraftQuery( );

	try
	{
		$Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
	}
	catch( MinecraftQueryException $e )
	{
		$Error = $e->getMessage( );
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Minecraft Query PHP Class</title>
	
	<!-- BOOSTRAP EST UN FRAMEWORK CSS QUI PERMET DE STYLISER LE CODE CI-DESSOUS, CA CODE LE CSS A VOTRE PLACE -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

	<!-- UN PEU DE CSS POUR ADAPTER BOOTSTRAP A NOS BESOINS -->
	<style type="text/css">
		.jumbotron {
			margin-top: 30px;
			border-radius: 0;
		}
		
		.table thead th {
			background-color: #428BCA;
			border-color: #428BCA !important;
			color: #FFF;
		}
		textarea:focus, input[type="text"]:focus,textarea[type="text"]:focus,   input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus,  input[type="color"]:focus, .uneditable-input:focus, .form-control:focus {  
		border-color: none;
		box-shadow:none;
		outline: none;
		}
	</style>

</head>

<body>

	<!-- ________________________________________________________________________________ -->
	<!-- L'UTILISATION DE TABLEAUX N'EST PAS OBLIGATOIRE, CA N'EST QU'UNE DEMONSTRATION	  -->
	<!-- 	VOUS POUVEZ ADAPATER LE HTML A VOS BESOINS MAIS NE MODIFIEZ PAS LE PHP SAUF	  -->
	<!-- 						SI VOUS SAVEZ CE QUE VOUS FAITES						  -->
	<!-- ________________________________________________________________________________ -->
	
	
	
	        <?php
	if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] ==  "thx") // Si le mot de passe est bon
	{
	// On affiche les codes
	?>
	
    <div class="container">
    	<div class="jumbotron">
			<h2>Baticraft Serveur</h2>
			
                        <p>Panneau de commandes :
						
						<form method="post" action="/serveur/?action=yes">
                          <input type="submit" name="exec" value="Lancer Serveur" >
                        </form>
						&nbsp;
						<form method="post" action="/serveur/?action=yes">
                          <input type="submit" name="exec" value="Eteindre Serveur" >
                        </form>
                        </p>
			
		</div>


<style>
#log {
overflow:auto;
height:250px;
background-color: black;
color: white;
width: 75%;
text-align:left;
};
</style>



    
<?php if( isset( $Exception ) ): ?>
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo htmlspecialchars( $Exception->getMessage( ) ); ?></div>
			<p><?php echo nl2br( $e->getTraceAsString(), false ); ?></p>
		</div>
<?php else: ?>
		<div class="row">
			<div class="col-sm-6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th colspan="2">Information serveur <em>(queried in <?php echo $Timer; ?>s)</em></th>
						</tr>
					</thead>
					<tbody>
						<?php if( ( $Info = $Query->GetInfo( ) ) !== false ): ?>
						<?php foreach( $Info as $InfoKey => $InfoValue ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $InfoKey ); ?></td>
							<td><?php
								if( Is_Array( $InfoValue ) )
								{
									echo "<pre>";
									print_r( $InfoValue );
									echo "</pre>";
								}
								else
								{
									echo htmlspecialchars( $InfoValue );
								}
							?>
							</td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="2">Pas d'informations reçues</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="col-sm-6">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Joueurs</th>
						</tr>
					</thead>
					<tbody>
						<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
						<?php foreach( $Players as $Player ): ?>
						<tr>
							<td><?php echo htmlspecialchars( $Player ); ?></td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td>Aucun joueur en ligne</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>

				<!-- Envoie de commande -->
				<table class="table table-bordered table-striped">
					<thead>
					<tr>
					<th>Envoyer une commande</th>
					</tr>
					</thead>

					<tbody>
						<tr>
							<td>
								<form method="post" role="form">
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-chevron-right"></span></span>
										<input type="text" name="command" class="form-control" placeholder="Entrez votre commande">
										<span class="input-group-btn">
										<input type="submit" name="submit" class="btn btn-default" value="Envoyer" />
										</span>
									</div>
								</form>

							</td>
						</tr>
					</tbody>

				</table>

			</div>
		</div>
<?php endif; ?>
	</div>
</body>
</html>


        <?php
	}
	else // Sinon, on affiche un message d'erreur
	{
	?>
			<form action="" method="post">
			<p>
			<input type="password" name="mot_de_passe" />
			<input type="submit" value="Valider" />
			</p>
		</form>
		
		<?php
	}
	?>
	