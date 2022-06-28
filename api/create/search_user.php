<?php  
require_once('../user.php');
$user = new User();
$user->setHobby($_POST['hobby']);
$user->setCity($_POST['city'], false);
$user->setGenre($_POST['genre'], false);
$user->setBirthday($_POST['age']);
$json = $user->search();
echo json_encode($json);