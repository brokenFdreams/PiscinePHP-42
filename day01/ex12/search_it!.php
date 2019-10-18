#!/usr/bin/php
<?php
$search = $argv[1];
$argv = array_reverse($argv);
for ($i = 0; $i < $argc - 2; $i++) {
	$tmp = explode(":", $argv[$i]);
	if ($tmp[0] === $search) {
		echo $tmp[1]."\n";
		break ;
	}
}
?>