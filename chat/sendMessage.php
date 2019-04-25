<?php
require 'connection.php';
header('Content-type: application/json');

$rooms_id = $_POST['rooms_id'];
$users_id = $_POST['users_id'];
$text = $_POST['text'];

$res = mysqli_query($db, "INSERT INTO olymp.message (text, rooms_id, users_id) VALUES ('$text', '$rooms_id', '$users_id')");
if($res){
  print_r(json_encode(['success' => true]));
}else{
  print_r(json_encode(['success' => false]));
}
