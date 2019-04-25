<?php
require 'connection.php';
session_start();

$name = (string)$_GET['name'];

$res = mysqli_query($db, "SELECT * FROM olymp.users WHERE name='$name'");
$user = mysqli_fetch_assoc($res);

if($name == ''){
  echo "Вы ввели некорректное имя! <a href=\"/chat/index.php\">Вернуться</a>";
  die();
}

function createRoom(){
  global $db;

  $createRoom = mysqli_query($db, "INSERT INTO olymp.rooms () VALUES ()");
  if(!$createRoom){
    echo mysqli_error($db);
  }

  $res = mysqli_commit($createRoom);

  $maxQ = mysqli_query($db, "SELECT MAX(id) as id FROM olymp.rooms");
  if(!$maxQ){
    echo mysqli_error($db);
  }

  $max = mysqli_fetch_assoc($maxQ);

  return $max['id'];
}

$rooms_id = createRoom();

function createUser($name, $rooms_id){
  global $db;

  $createUser = mysqli_query($db, "INSERT INTO olymp.users (name, rooms_id) VALUES ('$name', '$rooms_id')");
  if(!$createUser){
    echo mysqli_error($db);
  }
  
  mysqli_commit($createUser);

  $newUserQ = mysqli_query($db, "SELECT id FROM olymp.users WHERE name='$name'");
  $newUser = mysqli_fetch_assoc($newUserQ);

  return $newUser;
};

function changeRoom($users_id, $rooms_id){
  $updateUser = mysqli_query($db, "UPDATE olymp.users SET rooms_id=$rooms_id WHERE id=$users_id;");
  if(!$updateUser){
    echo mysqli_error($db);
  }

  mysqli_commit($updateUser);
}

if(!isset($user)){
  try {
    $user = createUser($name, $rooms_id);
    $_SESSION['users_id'] = $user['id'];
  }catch(Exception $e){
    echo $e . "<br>";
    exit;
  }
}else{
  changeRoom($user['id'], $rooms_id);
}

if(!isset($_SESSION['users_id'])){
  $_SESSION['users_id'] = $user['id'];
  var_dump($_SESSION);
}

header("Location: /chat/room.php?rooms_id=$rooms_id");
die();