<?php
	
		include('config.php');

		$debug = FALSE;

		// Récupération des données dans le fichier source et attribution des variables

		$check = $_GET['token'];
		$date = date("d/m/y");

		

		if ($personnaltoken==$check){

			$message = "Test";

			require_once('codebird.php');
 
			\Codebird\Codebird::setConsumerKey($consumerKey, $consumerSecret);
			$cb = \Codebird\Codebird::getInstance();
			$cb->setToken($accessToken, $accessTokenSecret);
 
			if($send_media == true){
				$params = array(
					'status' => $message,
					'media[]' => $path_to_media
				);
				$reply = $cb->statuses_updateWithMedia($params);
			}
			else{
				$params = array(
					'status' => $message,
				);
				$reply = $cb->statuses_update($params);
			}
				
		}
		else{ 
			echo "Token invalide !";
		}
?>