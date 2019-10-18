<?php
require('auth.php');
session_start();
if ($_POST['login'] != null && $_POST['passwd'] != null &&
	auth($_POST['login'], $_POST['passwd'])) {
	$_SESSION['loggued_on_user'] = $_POST['login'];
	echo "OK\n";
	?>
	<html>
		 <head><title>42chat</title></head>
		 <body>
		 <iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		 <iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
		 </body>
	</html>
<?php
} else {
	$_SESSION['loggued_on_user'] = "";
	header('Location: index.html');
	echo "ERROR\n";
}
?>
