<?php
session_start();
require_once('../../connectdb.php');
$user = array(
'email' => filter_var(trim($_POST['emailin']), FILTER_SANITIZE_STRING),
'pass' => filter_var(trim($_POST['passin']), FILTER_SANITIZE_STRING)
);
// $pass1 = md5('olkgpergksoiujlcxkbp123ktp4o56k3022kd;x', $pass);
$result = mysqli_query($dbc, "SELECT * FROM `users` WHERE `email` = '{$user['email']}' AND `pass` = '{$user['pass']}'");
$usercheck = mysqli_fetch_assoc($result);
print_r($usercheck);
echo "</br>";
if (is_array($usercheck) && !array_key_exists('name', $usercheck)){
    $_SESSION['error'] = 'Не верный Email или пароль!';
    exit(); header('Location: login.php');
} elseif(is_array($usercheck) && array_key_exists('name', $usercheck)) {
    if (array_count_values($_COOKIE) != 0){
        unset($_COOKIE['name']);
    }
} else {
    $_SESSION['error'] = "Произошла неизвестная ошибка!";
    exit(); header('Location: login.php');
}
$_SESSION['hello'] = "Добро пожаловать ". $usercheck['name'];
setcookie('name', $usercheck['name'], time() + 100);
header('Location: login.php');
?>