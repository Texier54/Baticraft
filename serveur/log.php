<center>
<pre id="log">
<?php
 $id = $_GET['id'];//on recup l'id dans url

exec('sudo -u root /root/startserv.sh '.$id.' status',$output,$error);
if($output[0]== "Running"){
	//l'id est deja recup sur la page au debut donc la variable existe deja aps besoin de recup ici
	if($id == 0){
	//le 500 apres le n correspond au nombre de ligne voulu
	 exec('tail -n 100 /root/Serveur/logs/latest.log',$output1,$error1);
	 }else if($id == 1){
	exec('tail -n 20 /root/Desert/logs/latest.log',$output1,$error1);
	 }else if($id == 2){
	exec('tail -n 20 /root/ftb/logs/latest.log',$output1,$error1);
	 }else if($id == 3){
	exec('tail -n 20 /root/Hellstar/logs/latest.log',$output1,$error1);
	 }else if($id == 4){
	 	
				$dossier="/root/teamspeak3/logs/";
				$ouverture=opendir($dossier);
				 
				 
				while ($fichier = readdir($ouverture)) {
					$files[] = $fichier;
				    }
				sort($files);
				//print_r($files[137]);
				
				$number= count($files)-1;
				
				$name = $files[$number];
				
				closedir($ouverture);
	
	
	exec('tail -n 20 /root/teamspeak3/logs/'.$name,$output1,$error1);
	 }else if($id == 5){
	exec('tail -n 20 /home/steam/arkdedicated/ShooterGame/Saved/Logs/ShooterGame.log',$output1,$error1);
	 }
	/* les id corresponde au id dans le fichier startserv
	** donc autant de else if que d'id =)
	 
	 
	 for($i=0; $output1[$i] != null ; $i++){
	 
	 echo htmlspecialchars ($output1[$i]).'<br>'; //on affiche ligne par ligne
	 
	 }
	*/
	 
	   foreach ($output1 as $value) 
	    {
	      $console = $value;
	       
	      $date = date("Y-m-d");   
	      $console = str_replace($date, '', $console);
	              
	      $msg_prefix = array("[INFO]", "[WARNING]", "[SEVERE]");
	      $color_prefix = array('<span style="color: #2E64FE;">[INFO]</span>', '<span style="color: #FF8000;">[WARNING]</span>', '<span style="color: #FF0040;">[SEVERE]</span>');
	      $console = str_replace($msg_prefix, $color_prefix, $console);
	      $console = htmlspecialchars($console);
	
	      echo '<div>';
	      echo translateMCColors($console);
	      echo '<br></div>';
	    }
    
   
 
 } else {
 
 echo 'Serveur OFF';
 
 }
 
 
 function translateMCColors($text) {
   $dictionary = array(
         '[30;22m' => '</span><span style="color: #000000;">', // §0 - Black
         '[34;22m' => '</span><span style="color: #0000AA;">', // §1 - Dark_Blue
         '[32;22m' => '</span><span style="color: #00AA00;">', // §2 - Dark_Green
         '[36;22m' => '</span><span style="color: #00AAAA;">', // §3 - Dark_Aqua
         '[31;22m' => '</span><span style="color: #AA0000;">', // §4 - Dark_Red
         '[35;22m' => '</span><span style="color: #AA00AA;">', // §5 - Purple
         '[33;22m' => '</span><span style="color: #FFAA00;">', // §6 - Gold
         '[37;22m' => '</span><span style="color: #AAAAAA;">', // §7 - Gray
         '[30;1m' => '</span><span style="color: #555555;">', // §8 - Dakr_Gray
         '[34;1m' => '</span><span style="color: #5555FF;">', // §9 - Blue
         '[32;1m' => '</span><span style="color: #55FF55;">', // §a - Green
         '[36;1m' => '</span><span style="color: #55FFFF;">', // §b - Aqua
         '[31;1m' => '</span><span style="color: #FF5555;">', // §c - Red
         '[35;1m' => '</span><span style="color: #FF55FF;">', // §d - Light_Purple
         '[33;1m' => '</span><span style="color: #FFFF55;">', // §e - Yellow
         '[37;1m' => '</span><span style="color: #FFFFFF;">', // §f - White
                  
         '[0;30;22m' => '</span><span style="color: #000000;">', // §0 - Black
         '[0;34;22m' => '</span><span style="color: #0000AA;">', // §1 - Dark_Blue
         '[0;32;22m' => '</span><span style="color: #00AA00;">', // §2 - Dark_Green
         '[0;36;22m' => '</span><span style="color: #00AAAA;">', // §3 - Dark_Aqua
         '[0;31;22m' => '</span><span style="color: #AA0000;">', // §4 - Dark_Red
         '[0;35;22m' => '</span><span style="color: #AA00AA;">', // §5 - Purple
         '[0;33;22m' => '</span><span style="color: #FFAA00;">', // §6 - Gold
         '[0;37;22m' => '</span><span style="color: #AAAAAA;">', // §7 - Gray
         '[0;30;1m' => '</span><span style="color: #555555;">', // §8 - Dakr_Gray
         '[0;34;1m' => '</span><span style="color: #5555FF;">', // §9 - Blue
         '[0;32;1m' => '</span><span style="color: #55FF55;">', // §a - Green
         '[0;36;1m' => '</span><span style="color: #55FFFF;">', // §b - Aqua
         '[0;31;1m' => '</span><span style="color: #FF5555;">', // §c - Red
         '[0;35;1m' => '</span><span style="color: #FF55FF;">', // §d - Light_Purple
         '[0;33;1m' => '</span><span style="color: #FFFF55;">', // §e - Yellow
         '[0;37;1m' => '</span><span style="color: #FFFFFF;">', // §f - White
                  
         '[5m' => '', // Obfuscated
         '[21m' => '<b>', // Bold
         '[9m' => '<s>', // Strikethrough
         '[4m' => '<u>', // Underline
         '[3m' => '<i>', // Italic
                  
         '[0;39m' => '</b></s></u></i></span>', // Reset
         '[0m' => '</b></s></u></i></span>', // Reset
         '[m' => '</b></s></u></i></span>', // End
         );
            
   $text = str_replace(array_keys($dictionary), $dictionary, $text);
              
   return '<span style="color: #BDBDBD;">'.$text;
 }
 
 
 
 
 
 ?>
</pre>
</center>
<script>
function scrollbot() {
  var elem = document.getElementById('log');
  elem.scrollTop = elem.scrollHeight;
};
scrollbot();
</script>