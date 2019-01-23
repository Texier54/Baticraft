<meta charset="UTF-8">
<style>
pre {
overflow:auto;
height:250px;
background-color: black;
color: white;
width: 75%;
text-align:left;
}
</style>
<?php
session_start();
if(isset($_SESSION['membre_id']) AND $_SESSION['membre_grade'] >= 6)
 {
 	
$id = 3;//on recup l'id dans url
?>
<link rel="stylesheet" href="/css/style.css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

<script>
  $(function(){
   setInterval(function(){
            var id = '<?php echo $id; ?>';
    $('#logs').load('log.php?id='+id);
   }, 2000);
  });
 </script>

<div id="logs">
<?php include('log.php');?>
</div>
<div style="width : 25%;margin : auto;">

<form method="post" action="index-trait.php">
<input type="hidden" name="type" value="cmd">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<label for="pseudo">Commande :</label>
<input type="text" name="arg"/>
<div class="center"><input type="submit" class="btn1" value="Envoyer" /></div>
</form>



<form method="post" action="index-trait.php">
<input type="hidden" name="type" value="start">
<input type="hidden" name="arg" value="">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="center"><input type="submit" class="btn1" value="Démarer le serveur" /></div>
</form>
<form method="post" action="index-trait.php">
<input type="hidden" name="type" value="stop">
<input type="hidden" name="arg" value="">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="center"><input type="submit" class="btn1" value="Arrêter le serveur" /></div>
</form>

</div>
<?php } ?>

