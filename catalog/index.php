<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
$cars = getCars();
?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
        <h1 class="text-black text-3xl font-bold mb-4">Каталог</h1>

        <?php includeTemplate('/cars_catalog.php', $cars);?>
    </div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>