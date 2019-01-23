        <meta charset="UTF-8">
<?php 



	//Connexion BDD
	include("../includes/database.php");
	$bdd->exec('USE forum');
	
/*	
	$idservice = '20';
	$retour= $bdd->query("SELECT * FROM thread WHERE node_id='" . $idservice . "' ");
	while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
	{
	
		$id = $donnees['id'];
		
		echo $id;
		
		$remplacement = '5';
		$bdd->query("UPDATE thread SET node_id='" . $remplacement . "' WHERE id='" . $id . "' ");
		
	}
	

	$idservice = 'rougerubi';
	$retour= $bdd->query("SELECT * FROM post WHERE username='" . $idservice . "' ");
	while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
	{
	
		$id = $donnees['id'];
		
		echo $id;
		
		$remplacement = '7';
		$bdd->query("UPDATE post SET user_id='" . $remplacement . "' WHERE id='" . $id . "' ");
		
	}

*/
	$id = '837';
	$retour= $bdd->query("SELECT * FROM post WHERE id='" . $id . "' ");
	$donnees = $retour->fetch(PDO::FETCH_ASSOC);

	$message = $donnees['message'];
	
	
	
	echo $message;
	
	//	$bdd->query("UPDATE post SET message='" . $message . "' WHERE id='" . $id . "' ");

?>
