#!/usr/bin/php
<?php
if ($argc > 2 && file_exists($argv[1])) {
	$read = fopen($argv[1]);
	$page = "";
	while ($read && !feof($read))
		$page .= $fgets($read);
	
}
?>