#!/usr/bin/php
<?php
if ($argc != 2)
	echo "Incorrect Parameters\n";
else {
	$str = str_replace(" ", "", $argv[1]);
	$a = intval($argv[1]);
	$sign = substr(substr($str, strlen((string)$a)), 0, 1);
	$b = substr(substr($str, strlen((string)$a)), 1);
	if (!is_numeric($a) || !is_numeric($b))
		echo "Syntax Error\n";
	else if ($sign == "+")
		echo $a + $b."\n";
	else if ($sign == "-")
		echo $a - $b."\n";
	else if ($sign == "*")
		echo $a * $b."\n";
	else if ($sign == "/")
		echo $a / $b."\n";
	else if ($sign == "%")
		echo $a % $b."\n";
}
?>
