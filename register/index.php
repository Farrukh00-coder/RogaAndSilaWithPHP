<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
if (isset($_SESSION['user_name'])) {
    header('Location: /profile/');
}

$registerSuccess = false;
$registerError = false;
$isRegistered = false;

if (! empty($_POST)) {
    $isRegistered = true;

    // если все поля заполнены и подтверждение пароля успешное то добавляем нового пользователя
    if (isset($_POST['name']) && ($_POST['name']) && isset($_POST['email']) && ($_POST['email']) && isset($_POST['password']) && (strlen($_POST['password']) >= 6) && isset($_POST['password_confirmation']) && ($_POST['password'] == $_POST['password_confirmation'])) {
    
        $registerSuccess = true;
    
        //подлючение к базе данных
        $connection = getConnection();
        //экранируем данные формы
        $userName = mysqli_real_escape_string($connection, $_POST['name']);
        $userEmail = mysqli_real_escape_string($connection, $_POST['email']);
        // хешируем пароль
        $userPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // добавляем нового пользователя в базу
        $addNewUser = (mysqli_query($connection, "INSERT INTO `users` (name, email, password)
        VALUES ('{$userName}', '{$userEmail}', '{$userPassword}')"));
    } else {
        $registerError = true;
    }
}

?>
    <main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
        <div class="py-4 pb-8">
            <h1 class="text-black text-3xl font-bold mb-4">Регистрация</h1>
            
            <?php if ($registerSuccess) {
                includeTemplate('messages/success_registration.php', ['message' => 'Вы успешно зарегистрированы']);
            } else {
                if ($registerError) {
                    includeTemplate('messages/error_registration.php', ['message' => 'Все поля обязательны заполнению']);
                }?>
            <form action="/register/" method="POST">
                <div class="mt-8 max-w-md">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="block">
                            <label for="fieldName" class="text-gray-700 font-bold">ФИО</label>
                            <input id="fieldName" name="name" value="<?=($isRegistered && $registerError) ? $_POST['name'] : ''?>" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Иванов Иван Иваныч">
                        </div>
                        <div class="block">
                            <label for="fieldEmail" class="text-gray-700 font-bold">Email</label>
                            <input id="fieldEmail" name="email" value="<?=($isRegistered && $registerError) ? $_POST['email'] : ''?>" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                        </div>
                        <div class="block">
                            <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                            <input id="fieldPassword" name="password" value="<?=($isRegistered && $registerError) ? $_POST['password'] : ''?>" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                        </div>
                        <div class="block">
                            <label for="fieldPasswordConfirmation" class="text-gray-700 font-bold">Подтверждение пароля</label>
                            <input id="fieldPasswordConfirmation" name="password_confirmation" value="<?=($isRegistered && $registerError) ? $_POST['password_confirmation'] : ''?>" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                        </div>
                        <div class="block">
                            <button type="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                                Регистрация
                            </button>
                            <a href="/login/" class="inline-block hover:underline focus:outline-none font-bold py-2 px-4 rounded">
                                У меня уже есть аккаунт
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php
}
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>