#!/usr/bin/php
<?PHP
$stdin = fopen("php://stdin", "r");
while ($stdin && !feof($stdin)) {
	echo "Enter a number: ";
	$num = trim(fgets($stdin));
	if ($num) {
		$num = str_replace("\n", "", $num);
	if (is_numeric($num)) {
			if ($num % 2 == 0)
				echo "The number $num is even\n";
			else
				echo "The number $num is odd\n";
		}
		else
			echo "'$num' is not a number\n";
	}
}
fclose($stdin);
echo "\n";
?>