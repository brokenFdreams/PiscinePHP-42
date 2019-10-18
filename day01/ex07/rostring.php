#!/usr/bin/php
<?php
if ($argv[1]) {
	$ar = array_filter(explode(" ", $argv[1]));
	$i = 1;
	while ($ar[$i])
		echo $ar[$i++]." ";
	echo $ar[0]."\n";
}
?>