#!/usr/bin/php
<?php
$ar = array();
$i = 1;
while ($argv[$i]) {
	$tmp = array_filter(explode(" ", $argv[$i]));
	foreach ($tmp as $s)
		$ar[] = $s;
	$i++;
}
sort($ar);
foreach($ar as $s)
	echo $s."\n";
?>
