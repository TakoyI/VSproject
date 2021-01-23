<?php 
session_start();
$user = array(
    'name' => filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING),
    'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING),
    'pass1' => filter_var(trim($_POST['pass1']), FILTER_SANITIZE_STRING),
    'pass2' => filter_var(trim($_POST['pass2']), FILTER_SANITIZE_STRING)
 );
 echo "Поиск: ";
 print_r($user);
 //CONNECTION MySQL
require_once('../../connectdb.php');
 //Check data correct
$result1 = mysqli_query($dbc, "SELECT `name` FROM `users` WHERE `name` = '{$user['name']}'");
$result2 = mysqli_query($dbc, "SELECT `email` FROM `users` WHERE `email` = '{$user['email']}'");
$namecheck = mysqli_fetch_assoc($result1);
$mailheck = mysqli_fetch_assoc($result2);
//NAME check
if (isset($namecheck)){
    $_SESSION['namecorrectno'] = "Пользователь уже существует";
    echo $_SESSION['namecorrectno'];
} else {
    $_SESSION['namecorrect'] = "Имя пользователя свободно для регистрации!";
    echo $_SESSION['namecorrect'];
    echo "</br>";
}
//EMAIL check
if (isset($mailheck)) {
    $_SESSION['emailcheckno'] = "Email уже зарегистрирован!";
    echo $_SESSION['emailcheckno']; exit();
} else {
    if (!preg_match("/\b[\w. -]+@[\w. -]+\.[A-Za-z]{2,6}\b/", $user['email'])) {
        $_SESSION['emailcorrectno'] = "Email не соответствует стандартам!";
        echo $_SESSION['emailcorrectno'];
        exit();
    }
    $_SESSION['emailcorrect'] = "Email доступен для регистрации!";
    echo $_SESSION['emailcorrect'];
}
//pass check
if ($user['pass1'] != $user['pass2']) {
    $_SESSION['passcorrectno'] = "Пароли не совпадаю!";
    echo $_SESSION['passcorrectno']; exit();
} else {
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $user['pass1'])) {
        $_SESSION['passcheckno'] = "Пароль должен содержать как минимум одну заглавную букву и его длина не может быть менее 8 символов. Нарушено одно из условий!";
        echo $_SESSION['passcheckno'];
        exit();
    }

}
// $user['pass1'] = md5('olkgpergksoiujlcxkbp123ktp4o56k3022kd;x', $user['pass1']);
echo "Пароли впорядке!";
//Build user in MySQL
if (mysqli_query($dbc, "INSERT INTO `users`(`name`, `email`, `pass`) VALUES ('{$user['name']}', '{$user['email']}', '{$user['pass1']}')")) {
    echo "Регистрация прошла успешно!";
} else {
    echo "Произошла неизвестная ошибка!";
}
// header('Location: registration.php');
?>