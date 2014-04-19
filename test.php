<?php
$code = "aaaaaa";
$hexa = "0123456789abcdef";

for($i=0; $i<6; $i++)
	$code[$i] = $hexa[rand(0, 15)];

echo $code;

?>