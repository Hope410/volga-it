<?php
require 'connection.php';
header('Content-type: application/json');

$rooms_id = $_GET['rooms_id'];

$res = mysqli_query($db, "SELECT text, olymp.users.name as name, date FROM olymp.message, olymp.users 
  WHERE olymp.message.rooms_id='$rooms_id' AND olymp.message.users_id = olymp.users.id;");
$messages = mysqli_fetch_all($res, 1);

print_r(json_encode($messages));