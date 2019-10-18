<?php
session_start();
date_default_timezone_set("Europe/Moscow");
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else {
	if (file_exists('../private') && file_exists('../private/chat')) {
		$chat = unserialize(file_get_contents('../private/chat'));
		foreach ($chat as $value)
			echo "[".date('H:i', $value['time'])."] <b>".$value['login']."</b>: ".$value['msg']."<br />";
	}
}
?>