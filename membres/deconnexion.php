<!DOCTYPE html>
    <?php
$titre_page = "Baticraft - Deconnexion";
$css = '<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/chargement.css" />';
$js = '<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>';

$haut = 1; require("../header.php");
header('Content-type: text/html; charset=utf-8');

if(!isset($_SESSION['membre_id']))
{
	header ("Refresh: 0;URL=/index.php");
}
else
{
	include('../includes/fonctions.php');
	vider_cookie();
	$_SESSION = array();
	session_destroy();
	?>
		<div class="chargement">
			<section class="section">
				<span class="loader loader-quart"></span>
				Deconnexion
			</section>
		</div>
	<?php
	header ("Refresh: 2;URL=/index.php");
}

include('../footer.php');
?>
		
</html>