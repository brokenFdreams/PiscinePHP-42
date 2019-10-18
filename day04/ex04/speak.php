<?php
session_start();
if (!$_SESSION['loggued_on_user'])
	echo "ERROR\n";
else {
	if ($_POST['msg']) {
		if (!file_exists('../private'))
			mkdir('../private');
		if (!file_exists('../private/chat'))
			file_put_contents('../private/chat', null);
		$data = unserialize(file_get_contents('../private/chat'));
		$fp = fopen('../private/chat', 'w');
		flock($fp, LOCK_EX);
		$tmp['login'] = $_SESSION['loggued_on_user'];
		$tmp['time'] = time();
		$tmp['msg'] = $_POST['msg'];
		$data[] = $tmp;
		file_put_contents('../private/chat', serialize($data));
		fclose($fp);
	}
	?>
	<html>
		 <form action="speak.php" method="POST">
		 <input type="text" name="msg" value="" />
		 <input type="submit" name="submit" value="Send" />
		 </form>
	</html>
<?php
	 }
?>