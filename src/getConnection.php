<?php


// подключение к базе данных
function getConnection()
{	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/src/config.php';

	static $connection = null;

	if (null === $connection) {
		$connection = mysqli_connect($host, $user, $password, $database) or die('connection Error');
	}

	return $connection;
}