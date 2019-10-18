<?php
if ($_POST['submit'] != null && $_POST['submit'] === "OK" &&
	$_POST['login'] != null && $_POST['passwd'] != null) {
	if (!file_exists('../private'))
		mkdir('../private');
	$exist = 0;
	if (file_exists('../private/passwd')) {
		$readdata = unserialize(file_get_contents('../private/passwd'));
		foreach ($readdata as $key => $value)
			if ($value['login'] === $_POST['login'])
				$exist = 1;
	}
	if ($exist === 1)
		echo "ERROR\n";
	else {
		$data['login'] = $_POST['login'];
		$data['passwd'] = hash('whirlpool', $_POST['passwd']);
		$forsave[] = $data;
		file_put_contents('../private/passwd', serialize($forsave), FILE_APPEND);
		echo "OK\n";
	}
} else
	echo "ERROR\n";
?>
