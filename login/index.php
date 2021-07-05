<?php


$authSuccess = false;
$authError = false;
$isAuthorized = false;
$inputEmail = '';
$inputPass = '';

if (! empty($_POST)) {
    require $_SERVER['DOCUMENT_ROOT'] . '/data/users.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/data/passwords.php';

    $inputEmail = $_POST['email'];
    $inputPass = $_POST['password'];
    $isAuthorized = true;
    $emailIndex = array_search($inputEmail, $emails);
    if ($emailIndex !== false && $inputPass == $passwords[$emailIndex]) {
        $authSuccess = true;
    } else {
        $authError = true;
    }
    
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';

?>

    <main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
        <div class="py-4 pb-8">
            <h1 class="text-black text-3xl font-bold mb-4">Авторизация</h1>

            <?php if ($isAuthorized && $authSuccess) {?>
                <?php includeTemplate('messages/success_message.php', ['message' => 'Все прошло успешно']);
            } elseif ($isAuthorized && $authError) {?>
                <?php includeTemplate('messages/error_message.php', ['message' => 'Неверный email или пароль']);
            }?>

            <form action="/login/" method="POST">
                <div class="mt-8 max-w-md">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="block">
                            <label for="fieldEmail" class="text-gray-700 font-bold">Email</label>
                            <input id="fieldEmail"  value="<?=($isAuthorized && $authError) ? $inputEmail : ''?>" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                        </div>
                        <div class="block">
                            <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                            <input id="fieldPassword" value="<?=($isAuthorized && $authError) ? $inputPass : ''?>" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="******">
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
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>