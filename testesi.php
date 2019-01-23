<?php 



$nombre= 7;
$i=1;

for($i=1;$i!=4;$i++)
{
	if($nombre % 3 != 0)
	$nombre=$nombre+4;
	else
	$nombre=$nombre+5;
}

echo $nombre;
?>