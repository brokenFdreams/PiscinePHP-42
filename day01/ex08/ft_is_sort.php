<?php
function ft_is_sort($tab) {
	$sort = $tab;
	sort($sort);
	foreach ($sort as $key=>$value)
		if ($value != $tab[$key])
			return false;
	return true;
}
?>