<?php
require_once('../user.php');
$user = new User();
$id_user = $_POST["id"];
$json = $user->read($id_user);
echo json_encode($json);