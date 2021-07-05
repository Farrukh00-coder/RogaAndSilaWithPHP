<?php

function cutString($line, $length = 12, $appends = '...'): string
{
	if (mb_strlen($line) <= $length) {
		return $line;
	}
	$tmp = mb_substr($line, 0, $length);
	return $tmp . $appends;
}