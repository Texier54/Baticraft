<?php
$type = $_POST['type'];
$arg = $_POST['arg'];
$id = $_POST['id'];//on recup l'id que le formulaire envoi

echo exec('sudo -u root /root/startserv.sh '.$id.' '.$type.' "'.$arg.'"');//on envoi la commande au bon serveur en specifiant l'id
header('Location: index.php?id='.$id);// on renvoi sur la bonne page avec le bon serveur
?>