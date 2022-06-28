<?php
require_once('../user.php');

$user = new User();
$user->setLastname($_POST['lastname']);
$user->setFirstname($_POST['firstname']);
$user->setEmail($_POST['email']);
$user->setBirthday($_POST['birthday']);
$user->setGenre($_POST['genre'], true);
$user->setCity($_POST['city'], true);
$user->setPassword($_POST['password']);
$user->setHobby_perso($_POST['hobby_perso']);
$user->setHobby($_POST['hobby']);
$json = $user->create();
echo json_encode($json);