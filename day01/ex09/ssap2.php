#!/usr/bin/php
<?php
function is_sort($a, $b)
{
	$a = strtolower($a);
	$b = strtolower($b);
	$length = strlen($a) < strlen($b) ? strlen($a) : strlen($b);
	for ($i = 0; $i < $length; $i++){
		$ai = ord(substr($a, $i, 1));
		$bi = ord(substr($b, $i, 1));
		if ($ai >= 48 && $ai <= 57)
			$ai -= 100;
		else if ($ai >=97 && $ai <= 122)
			$ai -= 200;
		if ($bi >= 48 && $bi <= 57)
			$bi -= 100;
		else if ($bi >=97 && $bi <= 122)
			$bi -= 200;
		if ($ai < $bi)
			return true;
		if ($ai > $bi)
			return false;
	}
	return strlen($a) <= strlen($b) ? true : false;
}

$ar = array();
$i = 1;
while ($argv[$i]) {
	$tmp = array_filter(explode(" ", $argv[$i]));
	foreach ($tmp as $s)
		$ar[] = $s;
	$i++;
}
$i = 0;
while($i < count($ar) - 1) {
	if (is_sort($ar[$i], $ar[$i + 1]))
		$i++;
	else {
		$tmp = $ar[$i];
		$ar[$i] = $ar[$i + 1];
		$ar[$i + 1] = $tmp;
		$i = 0;
	}
}
foreach($ar as $s)
	echo $s."\n";
?>