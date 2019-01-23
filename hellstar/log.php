<center>
<pre id="log">
<?php
 $id = 3;//on recup l'id dans url

exec('sudo -u root /root/startserv.sh '.$id.' status',$output,$error);
if($output[0]== "Running"){
//l'id est deja recup sur la page au debut donc la variable existe deja aps besoin de recup ici

exec('tail -n 20 /root/Hellstar/logs/latest.log',$output1,$error1);

/* les id corresponde au id dans le fichier startserv
** donc autant de else if que d'id =)
*/
 for($i=0; $output1[$i] != null ; $i++){
 
 echo htmlspecialchars ($output1[$i]).'<br>'; //on affiche ligne par ligne
 
 }
 
 } else {
 
 echo 'Server OFF';
 
 }?>
</pre>
</center>
<script>
function scrollbot() {
  var elem = document.getElementById('log');
  elem.scrollTop = elem.scrollHeight;
};
scrollbot();
</script>