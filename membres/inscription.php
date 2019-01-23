<!DOCTYPE html>
    <?php
$titre_page = "Baticraft - Inscription";
$css = '<link rel="stylesheet" href="../css/style.css" />' ;
$js = '<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>';

include("../header.php");
include('../includes/fonctions.php');


if(!isset($_SESSION['membre_id']))
{

	?>
	    
	<div id="bloc_page">
	
	<body>
	
		<br>
		
		<div class="inscription">
		
			<div class="center">
				<h2>Formulaire d'inscription</h2>
				<p>Bienvenue sur la page d'inscription de Baticraft !<br>
				Merci de remplir ces champs pour continuer.</p>
			</div>
			
			<form action="trait-inscription.php" method="post" name="Inscription" id="myForm">
				<fieldset><legend>Formulaire</legend>
					<br>
					
				<label for="pseudo_in" class="labelinscription">Pseudo :</label> <input required class="input" type="text" name="pseudo_in" id="pseudo_in" size="30" <?php if(isset($_GET['pseudo'])) echo 'value="'.$_GET['pseudo'].'"'; ?> /><br><br>
				<span class="tooltip">Un pseudo ne peut pas faire moins de 3 caractères</span><br>
						
				<label for="mail_in" class="labelinscription">Mail :</label> <input required class="input" type="email" name="mail_in" id="mail_in" size="30" <?php if(isset($_GET['mail'])) echo 'value="'.$_GET['mail'].'"'; ?> /><br><br>
				<span class="tooltip">L'adresse doit êtrede la forme nom@test.fr</span><br>
				
	        	<label for="mdp_in" class="labelinscription">Mot de passe :</label> <input required type="password" class="input" name="mdp_in" id="mdp_in" size="30" /><br><br>
	        	<span class="tooltip">Le mot de passe ne doit pas faire moins de 4 caractères</span><br>
				
				<label for="mdp_verif_in" class="labelinscription">Mot de passe :</label> <input required class="input" type="password" name="mdp_verif_in" id="mdp_verif_in" size="30" placeholder="Vérification" /><br><br>
				<span class="tooltip">Le mot de passe doit être identique</span><br>
				
				<label for="date_naissance" class="labelinscription">Date de naissance :</label> <input required class="input" type="text" name="date_naissance" id="date_naissance" size="30" placeholder="(JJ/MM/AAAA)" <?php if(isset($_GET['naissance'])) echo 'value="'.$_GET['naissance'].'"'; ?> /><br><br><br>
				
				<div class="center">
					<div class="g-recaptcha" data-sitekey="6LeS3QoUAAAAABBk3RYekBOO3i5kFDWet6t43bgN"></div>
				</div>
				
				<br>
				
					<div class="center"><input type="submit" class="btn1" value="Inscription" /></div>
				</fieldset>
			</form>
			
			
<script>

// Fonction de désactivation de l'affichage des "tooltips"
function deactivateTooltips() {

    var tooltips = document.querySelectorAll('.tooltip'),
        tooltipsLength = tooltips.length;

    for (var i = 0; i < tooltipsLength; i++) {
        tooltips[i].style.display = 'none';
    }

}


// La fonction ci-dessous permet de récupérer la "tooltip" qui correspond à notre input

function getTooltip(elements) {

    while (elements = elements.nextSibling) {
        if (elements.className === 'tooltip') {
            return elements;
        }
    }

    return false;

}


// Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok

var check = {}; // On met toutes nos fonctions dans un objet littéral

check['pseudo_in'] = function() {

    var pseudo_in = document.getElementById('pseudo_in'),
        tooltipStyle = getTooltip(pseudo_in).style;

    if (pseudo_in.value.length >= 3) {
        pseudo_in.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pseudo_in.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

function isEmail(myVar){
     // La 1ère étape consiste à définir l'expression régulière d'une adresse email
     var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');

     return regEmail.test(myVar);
   }
   
   
check['mail_in'] = function() {

    var mail_in = document.getElementById('mail_in'),
        tooltipStyle = getTooltip(mail_in).style;

    if (isEmail(mail_in.value) == true) {
        mail_in.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        mail_in.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};


check['mdp_in'] = function() {

    var mdp_in = document.getElementById('mdp_in'),
        tooltipStyle = getTooltip(mdp_in).style;

    if (mdp_in.value.length >= 4) {
        mdp_in.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        mdp_in.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

check['mdp_verif_in'] = function() {

    var mdp_in = document.getElementById('mdp_in'),
        mdp_verif_in = document.getElementById('mdp_verif_in'),
        tooltipStyle = getTooltip(mdp_verif_in).style;

    if (mdp_in.value == mdp_verif_in.value && mdp_verif_in.value != '') {
        mdp_verif_in.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        mdp_verif_in.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

	// Mise en place des événements
	
	(function() { // Utilisation d'une IIFE pour éviter les variables globales.
	
	var myForm = document.getElementById('myForm'),
	inputs = document.querySelectorAll('input[type=text], input[type=password], input[type=email]'),
	inputsLength = inputs.length;
	
	for (var i = 0 ; i < inputsLength ; i++) {
	inputs[i].addEventListener('keyup', function(e) {
	check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
	}, false);
	}

	
	myForm.addEventListener('reset', function() {
	
	for (var i = 0 ; i < inputsLength ; i++) {
	inputs[i].className = 'input';
	}
	
	deactivateTooltips();
	
	}, false);
	
	})();
	
	
	// Maintenant que tout est initialisé, on peut désactiver les "tooltips"
	
	deactivateTooltips();

</script>
				
		</div>


	    <br><br><br><br><br>
			
	<!--bas-->
	<?php
		include ("../footer.php"); 
		
		
}
else header ("Refresh: 0;URL=./index.php");

?>
        
</body>

</div>

</html>