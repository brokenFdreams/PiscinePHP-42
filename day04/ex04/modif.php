<?php
if ($_POST['submit'] != null && $_POST['submit'] === "OK" && $_POST['login'] != null &&
	$_POST['oldpw'] != null && $_POST['newpw'] != null) {
	$readdata = unserialize(file_get_contents('../private/passwd'));
	$exist = 0;
	foreach ($readdata as $key => $value)
		if ($value['login'] === $_POST['login'] &&
			$value['passwd'] === hash('whirlpool', $_POST['oldpw'])) {
			$exist = 1;
			$readdata[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
		}
	if ($exist === 1) {
		file_put_contents('../private/passwd', serialize($readdata));
		header('Location: index.html');
		echo "OK\n";
	} else
		echo "ERROR\n";
} else
	echo "ERROR\n";
?>