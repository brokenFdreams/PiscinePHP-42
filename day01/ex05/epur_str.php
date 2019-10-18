#!/usr/bin/php
<?php
$ar = explode(' ', $argv[1]);
$i = 0;
$count = count($ar);
$flag = 0;
while ($i < $count)
{
	if ($ar[$i] && $flag)
		echo " ".$ar[$i];
	else if ($ar[$i] && ($flag = 1))
		echo $ar[$i];
	$i++;
}
echo "\n";
?>