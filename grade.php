<!DOCTYPE html>
    <?php
$titre_page = "Baticraft - Différents grades";
$css = '<link rel="stylesheet" href="css/style.css" />' ;
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/modal.js"></script>
<script src="/js/bootstrap.min.js"></script>';

include("header.php");
    ?>

<body>
	
	<br><br>
	
	<header>
	
		<div class="sommaire"> 
		<br><br>
		
<center>


<div class="titre">	
Les grades de Baticraft 
</div>

<br><br><br>

<div class="sommairetext">
Voici la liste des différents grades présent sur Baticraft, ainsi que leur droits et possibilités.<br><br>



<div class="titre2"><span style="color:#AAAAAA">Visiteur</span> : Le Visiteur est un nouveau joueurs n'ayant pas remplit de formulaire.</div>
<br>
     Obtention : Ce grade vous est donné lors de votre première connexion en jeu.<br>
     Droits : Vous pouvez visiter la map du serveur ainsi que discuter ou jouer au Dé à Coudre avec les joueurs connectés.<br>
     Commandes principales :  <br><br>
                         &nbsp;&nbsp;&nbsp;&nbsp;   /list (permet de voir la liste des connectés)<br><br>
                         &nbsp;&nbsp;&nbsp;&nbsp;   /spawn (permet de retourner au Spawn)<br><br>
                         &nbsp;&nbsp;&nbsp;&nbsp;   /helpop [Problème/Demande/Question] (permet de demander une assistance au Staff)<br><br>
                         &nbsp;&nbsp;&nbsp;&nbsp;   /modreq [Problème/Demande/Question] (permet de mettre en liste d'attente votre demande d’assistance du Staff)<br><br><br>


<div class="titre2"><span style="color:#05AAAA">Citoyen</span> : Le Citoyen est un nouveau membre sur le serveur.</div>

<br>

     Obtention : En tant que Visiteur vous devez faire le QCM des Visiteurs disponible directement depuis le serveur. Pour toutes les informations, rendez-vous aux panneaux des informations. Il sera ensuite accepté ou refusé.<br>
     Droits : (en plus de ceux des Visiteurs) Vous pouvez choisir un métier pour vous enrichir, vous pouvez acheter une parcelle/maison par ville
	 (et champs si vous êtes fermier) et accéder à la construction de ses créations personnelles, tant qu’elles ne sont pas en désaccord avec le règlement.
	 Le Citoyen a aussi l'accès à la Map Ressources. Il peut proposer ses projets sur le forum, participer à la vie active du serveur :
	 Participer à des Évents, jouer aux différents jeux disponibles... ect.<br>
     Commandes principales : (en plus de celles des Visiteurs)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /sethome [nom_du_home] (permet de définir votre maison)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /home [nom_du_home] (permet de vous rendre à votre maison)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /money (permet d'affiche votre budget personnel en Po)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /money pay ou /pay [Pseudo] [Montant]<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /tpaccept et /tpdeny (permet d'accepter/de refuser qu’un joueur se téléporte a vous)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /me (permet de parler à la troisième personnes)<br><br><br>


<div class="titre2"><span style="color:#57FFFF">Marchand</span> : Le Marchand est un joueur actif avec la communauté.</div>

<br>

     Obtention : Vous devez d'abord être Citoyen. Il vous faudra atteindre la somme de 5 000 Po, biens compris (maisons et champs),
     avoir un shop opérationnel dans chaque ville ouverte, avoir au minimum 2 mois d'anciennetés (à partir de la validation de votre QCM),
     être présent et actif sur le forum et le serveur, savoir correctement rédiger une discussion sur le forum, être mature sur le serveur
     et parler avec une orthographe correcte. Le changement de grade sera facturé 1000po déduit de l'enveloppe des 5000po.
     Si les critères principaux pour obtenir le grade sont tous remplis et que nous jugeons nécessaire
     de vérifier votre aptitude à être Marchand, nous vous ferons passer un entretien oral sur notre serveur TeamSpeak 3 pour décrocher votre grade.<br><br>
     Droits : (en plus de ceux des Citoyens)<br><br>
     										  	L'accès aux couleurs dans les chat.<br><br>
	                                          	Le droit à plusieurs homes (3).<br><br>
     Commandes principales : (en plus de celles des Citoyens)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /say [message] (permet d'envoyer une message pour vendre ou faire du trade)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /suicide (permet de se suicider)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /tpa [nom_du_joueur] (permet d'envoyer une demande de téléportation à un joueur)  <div style="color:red"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;VEUILLEZ NE PAS ABUSER DE CETTE COMMANDE !</div><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /compass (permet de voir son orientation)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /getpos (permet de voir sa position)<br><br><br>






<div class="titre2"><span style="color:#55FF55">Bourgeois</span> : Le Bourgeois est un Citoyen qui a déjà fait ses preuves et que nous connaissons bien.</div>
<br>
     Obtention : Vous devez d'abord être Citoyen. Il vous faudra atteindre la somme de 5 000 Po, biens compris (maisons et champs),
	 avoir deux maisons, avoir au minimum 2 mois d'anciennetés (à partir de la validation de votre QCM), être présent et
	 actif sur le forum et le serveur, savoir correctement rédiger une discussion sur le forum, être mature sur le serveur et
	 parler avec une orthographe correcte. Vous devez également avoir un compte sur le site internet. Le changement de grade sera facturé 1000po déduit de l'enveloppe des 5000po.
	 Si les critères principaux pour obtenir le grade sont tous remplis et que nous
	 jugeons nécessaire de vérifier votre aptitude à être Bourgeois, nous vous ferons passer un entretien oral sur notre
	 serveur TeamSpeak 3 pour décrocher votre grade.<br><br>
     Droits : (en plus de ceux des Citoyens)<br><br>
     										  	L'accès aux couleurs dans les chat.<br><br>
	                                          	Le droit à plusieurs homes (3).<br><br>
							Commandes principales : (en plus de celles des Citoyens)<br><br>
                             &nbsp;&nbsp;&nbsp;&nbsp;   /suicide (permet de se suicider)<br><br>
                             &nbsp;&nbsp;&nbsp;&nbsp;   /tpa [nom_du_joueur] (permet d'envoyer une demande de téléportation à un joueur)  <div style="color:red"> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;VEUILLEZ NE PAS ABUSER DE CETTE COMMANDE !</div><br>
                             &nbsp;&nbsp;&nbsp;&nbsp;   /compass (permet de voir son orientation)<br><br>
                             &nbsp;&nbsp;&nbsp;&nbsp;   /getpos (permet de voir sa position)<br><br><br>






<div class="titre2">Maire : Le Maire est un Bourgeois ayant une ville finie ou en construction.</div>
<br>
     Obtention : Vous devez d'abord être Citoyen. Il faut avoir une ville en construction ou déjà finie.<br>
     Droits : (en plus de ceux des Bourgeois). Vous pourrez gérer totalement et de manière autonome votre ville.<br>
     Commandes principales : (en plus de celles des Bourgeois)<br><br>
                               Commandes WorldGuard permettant de gérer vos parcelles. Ces commandes et l'utilisation des
							   panneaux de ventes vous seront directement expliquées par un membre du Staff dès qu'il sera disponible.<br><br><br>






<div class="titre2"><span style="color:#5655FF">Comte</span> : Le Comte est un joueur important du serveur qui a droit à quelques privilèges.</div>
 <br>
     Obtention : Vous devez d'abord être bourgeois ou marchand. Il vous faudra accumuler un  minimum de 10000 Po, biens compris (maisons, shops et champs),
     une maison dans chaque ville ouverte, avoir au minimum 6 mois d'ancienneté (à partir de la validation de votre QCM), être présent et actif
     sur le forum et le serveur, savoir correctement rédiger une discussion sur le forum, être mature sur le serveur et parler avec une
     orthographe correcte. Vous devez également avoir un compte sur le site internet. Le changement de grade sera facturé 2000po déduit de l'enveloppe des 10000po.
     Si les critères principaux pour obtenir le grade sont tous remplis et que nous jugeons nécessaire de vérifier
     votre aptitude à être Comte, nous vous ferons passer un entretien oral sur notre serveur TeamSpeak 3 pour décrocher votre grade.<br>
     Droits : Le droit d'acheter une parcelle en dehors des villes. L'achat d'une telle parcelle étant un privilège, il vous sera demander de
     la respecter et de ne pas y construire n'importe quoi.<br>
     Commandes principales : <br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   Toutes les commandes bourgeois et marchands<br><br><br>
                            
                            
                            
                            
                            
                            
<div class="titre2"><span style="color:#AA00AA">Animateur</span> : L'Animateur est un Citoyen (ou plus) animant les soirée sur le serveur.</div>
 <br>
     Obtention : Vous devez d'abord être au minimum Citoyen. Proposer et concrétiser un Évent (si il est accepté). Vous aurez le
	 grade lors de votre soirée spécifique à votre Évent. Si vous vous investissez souvent en proposant des petits concours sur les
	 jeux déjà disponibles sur le serveur et en animant la communauté votre grade d'Animateur sera permanent.<br>
     Droits : (en plus de votre grade actuel) Vous pourrez gérer totalement et de manière autonome votre Évent lors de la soirée.
	 Si votre grade est permanent, vous pourrez proposer des petits concours sur les jeux déjà existant.<br>
     Commandes principales : (en plus de votre grade actuel)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /tpaall (permet d'envoyer une demande de téléportation pour tous les joueurs)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /tpahere (permet d'envoyer une demande de téléportation à un joueur)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /mute (permet de rendre silencieux un joueur)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /fly (permet de voler)<br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;   /feed (permet de se nourrir)<br><br><br>





<div class="titre2"><span style="color:#FF55FF">VIP</span> : Le VIP est un joueurs ayant soit été invité ou ayant une assez grande popularité.</div>
<br>
     Obtention : Avoir reçu une invitation de la part du Staff ou être jugé assez populaire par les membres du Staff.<br>
     Droits :  Le VIP a les mêmes droits que les Bourgeois.<br>
     Commandes principales :<br> <br>
	 Le VIP a les mêmes commandes que les Animateurs.<br><br><br>
                            






<div class="titre2"><span style="color:#FFAA02">Modérateur</span> : </div>
<br>
Le Modérateur est un joueur important, il a de nombreux droits. Il s’occupe des problèmes des joueurs et répond à leurs questions. Ses décisions font loi en l'absence des Administrateurs. Le Modérateur est une personne de confiance. Seuls les Administrateurs choisissent qui devient Modérateur.
<br><br><br>



<div class="titre2"><span style="color:#AA0000">Administrateur</span> : </div>
<br>
L'Administrateur gère entièrement le serveur. C'est lui qui donne les autorisations pour des projets, choisis les Citoyens, Bourgeois, Maires, Animateurs et Modérateurs, il a tous les pouvoirs sur les différentes villes. Il organise régulièrement les événements spéciaux au cours desquels divers grades sont en jeu. <br><br><br>

<p class="maj"> MAJ : 16/02/2017 </p>

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