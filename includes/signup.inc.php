<?php

if (isset($_POST['submit'])) {  //суперглобальная переменная post, ссылается на атрибут name в input

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];

    require_once 'dbh.inc.php';  //включит и выполнит файл один раз, в случае возникновения ошибки выдаст фатальную ошибку и остановит выполнение скрипта 
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) { // если оставил входные данные пустые (1 или n раз)
        header('Location: ../signup.php?error=emptyinput'); //отправляет заголовок браузеру и возвращает код состояния
        exit();
    }

    if (invalidUid($username) !== false) {  // проверка на недопустимые символы в имени пользователя
        header('Location: ../signup.php?error=invaliduid');
        exit();
    }

    if (invalidEmail($email) !== false) { // проверка на недопустимые символы в имени электронной почты
        header('Location: ../signup.php?error=invalidemail');
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {  // совпадают ли пароли
        header('Location: ../signup.php?error=passwordsdontmatch');
        exit();
    }

    if (uidExists($conn, $username, $email) !== false) { // существующее имя пользователя
        header('Location: ../signup.php?error=usernametaken');
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd); // если не допущено ошибок - вызов функции создания пользователя (регистрация)

} else {
    header('Location: ../signup.php');
    exit();
}
