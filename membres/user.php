<?php
/*
Neoterranos & LkY
Page index.php

Affichage de profil.

Quelques indications (utiliser l'outil de recherche et rechercher les mentions données) :

Liste des fonctions :
--------------------------
Aucune fonction
--------------------------


Liste des informations / erreurs :
--------------------------
Le membre n'existe pas
--------------------------
*/

session_start();

include('../includes/config.php');

/********Actualisation de la session...**********/

include('../includes/fonctions.php');
connexionbdd();
actualiser_session();

/********Fin actualisation de session...**********/
?>
<!--contenu//-->
                <div class="contenu">
                        <div class="map">
                                <a href="../index.php">Accueil</a> => <a href="user.php?id=<?php echo intval($profil['membre_id']); ?>">Profil de <?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?></a>
                        </div>
                        
                        <h1>Profil de <?php echo htmlspecialchars($profil['membre_pseudo'], ENT_QUOTES); ?></h1>
                        
                        <div class="profil_cellule_float">
                                <h2>Informations générales</h2>
                                
                                
                                <div class="avatar">
                                <?php
                                if($profil['membre_avatar'] == '')
                                {
                                        echo 'Pas d\'avatar';
                                }
                                ?>
                                </div>
<p>test</p>
