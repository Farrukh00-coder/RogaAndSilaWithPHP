<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
$cars = getCars();
?>
<?=includeTemplate('/cars_catalog.php', $cars)?>
<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/cars_catalog.php';
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>