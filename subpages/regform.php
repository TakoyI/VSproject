<?php 
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$pass1 = filter_var(trim($_POST['pass1']), FILTER_SANITIZE_STRING);
$pass2 = filter_var(trim($_POST['pass2']), FILTER_SANITIZE_STRING);
//Connection MySQL
$mysql = new mysqli('localhost', 'root', 'root', 'phanforum_db');
$result = $mysql->query("SELECT 1 FROM 'users' WHERE 'name' = '$name'");


?>