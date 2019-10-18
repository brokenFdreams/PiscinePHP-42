<?php
$flag = 0;
$name = "";
$val = "";
if ($_GET["action"] === "set")
	$flag = 1;
else if ($_GET["action"] === "get")
	$flag = 2;
else if ($_GET["action"] === "del")
	$flag = 3;
if ($flag != 0) {
	$name = $_GET["name"];
	$val = $_GET["value"];
}
if ($flag === 1)
	setcookie($name, $val, time() + (86400 * 30), '/');
else if ($flag === 2 && $_COOKIE[$name] != null)
	echo $_COOKIE[$name]."\n";
else if ($flag === 3)
	setcookie($name, '', time() - 3600);
?>