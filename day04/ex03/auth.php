<?php
function auth($login, $passwd) {
	if ($login != null && $passwd != null) {
		$data = unserialize(file_get_contents('../private/passwd'));
		if ($data != null)
			foreach ($data as $key => $value)
				if ($value['login'] === $login &&
					$value['passwd'] === hash('whirlpool', $passwd))
					return TRUE;
	}
	return FALSE;
}
?>