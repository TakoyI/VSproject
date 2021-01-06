<?php 
session_start();
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$pass1 = filter_var(trim($_POST['pass1']), FILTER_SANITIZE_STRING);
$pass2 = filter_var(trim($_POST['pass2']), FILTER_SANITIZE_STRING);
//Connection MySQL
require ('../../connectdb.php');
//Check user name for correct
$namecheck = $dbc->query("SELECT 1 FROM 'users' WHERE 'name' = '$name'");
if (!empty($namecheck)) {
    $_SESSION['namenocorrect'] = 'Имя пользователя уже зарегистрированно!';
    exit();
//    header('Location: authentification.html');
} else {
    $_SESSION['namecorrect'] = 'Имя пользователя прошло проверку!';
}
//Check Email for correct
$emailcheck = $dbc->query("SELECT 1 FROM 'users' WHERE'email' = '$email'");
if (!preg_match("/\b[\w. -]+@[\w. -]+\.[A-Za-z]{2,6}\b/",$email) || !empty($emailcheck)) {
    $_SESSION['emailnocorrect'] = 'Email не корректен или уже зарегистрирован!';
    exit(); header('Location: authentification.html');
} else {
    $_SESSION['emailcorrect'] = 'Email прошёл проверку!';
}
//Check pass for correct
if ($pass1 != $pass2 ) {
    $_SESSION['passcheck'] = 'Пароли не совпадают!';
    exit();
} else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pass1)) {
    $_SESSION['passcheck'] = 'Пароль должен содержать как минимум одну заглавную букву и его длина не может быть менее 8 символов. Нарушено одно из условий!';
    exit(); header('Location: authentification.html');
} else {
    $_SESSION['passcorrect'] = 'Пароль прошёл проверку и может быть использован при регистрации!';
}
//Coding password
$pass1 = md5($pass1, "ler4p3k1[plzv452");
//Create User in DB
$request= "INSERT INTO users (`email`,`name`, `pass`) VALUES('$email', '$name', '$pass1')";
if (mysqli_query($dbc, $request)){
    $_SESSION['registcorrect'] = 'Регистрация завершена успешно!';
} else {
    $_SESSION['registerror'] = 'Произошла неизвестная ошибка, пожалуйста сообщите нам о ней...';
}
header('Location: authentification.html');
?>