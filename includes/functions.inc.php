<?php
// обработчики ошибок

// регистрация
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
    $result = '';

    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) { // empty - проверяет пустая ли переменная
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidUid($username)
{
    $result = '';

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {  // preg_match - выполняет проверку на соответсвие регулярному выражению (1я позиция)
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    $result = '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //filter_var - фильтрует переменную, FILTER_VALIDATE_EMAIL - фильтр проверки адреса
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    $result = '';

    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;"; // выбрать из таблицы пользователей где логин = ?, знак ? это заполнитель
    $stmt = mysqli_stmt_init($conn); //Инициализирует запрос и возвращает объект для использования в mysqli_stmt_prepare

    if (!mysqli_stmt_prepare($stmt, $sql)) { //подготавливает инструкцию SQL к выполнению
        header('Location: ../signup.php?error=stmtfailed');
        exit();
    } //проверка на отсутсвие ошибок

    mysqli_stmt_bind_param($stmt, 'ss', $username, $email); //Привязка переменных к параметрам подготавливаемого запроса, ss - определяет тип передаваемого значения - строка, в данном случае две строки
    mysqli_stmt_execute($stmt); // Выполняет подготовленное утверждение

    $resultData = mysqli_stmt_get_result($stmt); //Получает набор результатов из подготовленного оператора в виде объекта

    if ($row = mysqli_fetch_assoc($resultData)) { // создание ассоциативного массива из результата
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt); // закрывает выполнение подготовленного заявления
}

function createUser($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (userName, userEmail, userUid, userPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../signup.php?error=stmtfailed');
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: ../signup.php?error=none');
    exit();
}

// авторизация
function emptyInputLogin($username, $pwd)
{
    $result = '';

    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header('Location: ../login.php?error=wronglogin');
        exit();
    }

    $pwdHashed = $uidExists['userPwd'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header('Location: ../login.php?error=wronglogin');
        exit();
    } elseif ($checkPwd === true) {
        session_start();
        $_SESSION['userid'] = $uidExists['userId'];
        $_SESSION['useruid'] = $uidExists['userUid'];
        header('Location: ../index.php');
        exit();
    }
}
