<?php  
require_once('../user.php');
$user = new User();
$user->setEmail($_POST['email']);
$user->setPassword_user($_POST['password']);
$json = $user->check_login();
echo json_encode($json);