<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

if (isset($_SESSION['user_name'])) {
    header('Location: /profile/');
}


$authSuccess = false;
$authError = false;
$isAuthorized = false;


if (! empty($_POST)) {
    $isAuthorized = true;
    // подключение к базе данных
    $connection = getConnection();
    // экранируем mail
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    // если есть пользователь с mail из формы, то выбираем его с полями id и password
    $user = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `id`, `password` FROM `users` WHERE `email`='{$email}' LIMIT 1"));

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $authSuccess = true;
        $_SESSION['isAuth'] = true;
        $_SESSION['user_name'] = $_POST['email'];
        $_SESSION['id'] = $user['id'];
        //при успешной авторизации создаем куку с длительностью 1 месяц
        setcookie('email', $_POST['email'], time() + 3600*24*30, "/");
    } else {
        $authError = true;
    }

}
if (isset($_SESSION['isAuth']) && $_SESSION['isAuth']) {
    if ($isAuthorized) {
        header("Location: /login/?login=yes");
    }
}
?>

    <main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
        <div class="py-4 pb-8">
            <h1 class="text-black text-3xl font-bold mb-4">Авторизация</h1>
            <?php if (isset($_SESSION['isAuth']) && $_SESSION['isAuth']) {
                includeTemplate('messages/success_message.php', ['message' => 'Все прошло успешно']);
            } else {
                if ($isAuthorized && $authError) {
                    includeTemplate('messages/error_message.php', ['message' => 'Неверный email или пароль']);
            }?>

            <form action="/login/" method="POST">
                <div class="mt-8 max-w-md">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="block">
                            <label for="fieldEmail" class="text-gray-700 font-bold">Email</label>
                            <input id="fieldEmail"  value="<?=($_POST['email']) ?? ($_COOKIE['email'] ?? '')?>" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                        </div>
                        <div class="block">
                            <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                            <input id="fieldPassword" value="<?=($isAuthorized && $authError) ? $_POST['password'] : ''?>" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
                        </div>
                        <div class="block">
                            <button type="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                                Войти
                            </button>
                            <a href="/register.html" class="inline-block hover:underline focus:outline-none font-bold py-2 px-4 rounded">
                                У меня нет аккаунта
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php }
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>