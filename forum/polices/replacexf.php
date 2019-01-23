<?php

//mysql_connect("localhost", "root", "batinews");
$bdd = new PDO("mysql:host=localhost", "root", "batinews");
//mysql_select_db("Site");
$bdd->exec('USE forum');

							$retour = $bdd->query("SELECT * FROM thread WHERE node_id='17' ORDER by post_date DESC ");
							while($donnees = $retour->fetch(PDO::FETCH_ASSOC))
							{
								$bdd->query("UPDATE thread SET node_id='2' WHERE thread_id='".$donnees['thread_id']."' ");
							}
?>