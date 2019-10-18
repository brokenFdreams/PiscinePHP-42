<?php
function ft_split($str)
{
	$ar = array_filter(explode(' ', $str));
	sort($ar);
	return $ar;
}
?>