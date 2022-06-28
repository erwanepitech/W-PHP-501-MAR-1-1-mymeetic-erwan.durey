<?php
require_once('../user.php');
$user = new User();

$user->setEmail($_POST['email']);
$user->setPassword_user($_POST['password']);
if ($_POST["password_verify"] != "" || $_POST["password_verify"] != null) {
    $user->setPassword($_POST['password_verify']);
}
$user->setLastname($_POST['lastname']);
$user->setFirstname($_POST['firstname']);
$user->setCity($_POST['city'], true);
$user->set_Id_user($_POST['id']);
$json = $user->update();
echo json_encode($json);