<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

if (!isset($_SESSION['user_name'])) {
	header('Location: /login/');
}

$connection = getConnection();
$id = mysqli_real_escape_string($connection, $_SESSION['id']);
//сохраняем данные о пользователе
$userData = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `name`, `email`, `phone`, `password` FROM `users` WHERE `id` = '{$id}'"));
//делаем запрос для получения всех групп пользователя
$userGroups = mysqli_query($connection, "SELECT groups.name, groups.description FROM `group_user`
		LEFT JOIN `groups` ON group_user.group_id = groups.id
		WHERE group_user.user_id = '{$id}'"
	);
//создаем массив чтобы сохранить туда все наши группы
$groups = [];
while ($group = mysqli_fetch_assoc($userGroups)) {
	$groups[] = $group;
}

?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
    	<h1 class="text-black text-3xl font-bold mb-4">Данные пользователя</h1>
    	<ul>
    		<li>Имя : <?=$userData['name']?></li>
    		<li>Email : <?=$userData['email']?></li>
    		<li>Phone : <?=$userData['phone']?></li>
    		<li>Password : <?=$userData['password']?></li>
    	</ul>
    	<br><br>
    	<h1 class="text-black text-3xl font-bold mb-4">Группы</h1>
    	<ul>
    		<?php foreach ($groups as $group) {?>
    			<li>Имя : <?=$group['name']?> - Описание: <?=$group['description']?></li>
    		<?php }?>
    	</ul>
    </div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>
