<?php
	if(isset($js)) echo $js;
if (date("n") == 1 OR date("n") == 12)
{
	?>
	<script src="/js/snowstorm.js"></script>
	<?php
}
?>
<div class="center">
	<br>
	<div class="footer"> &copy;2013-<?php echo date('Y'); ?> - Baticraft.tk - Réalisé par Texier54</div>
</div>

<?php 	$bdd = null;  ?>