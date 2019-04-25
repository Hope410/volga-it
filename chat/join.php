<?php
require 'connection.php';
session_start();

function changeRoom($users_id, $rooms_id){
  $updateUser = mysqli_query($db, "UPDATE olymp.users SET rooms_id=$rooms_id WHERE id=$users_id;");
  if(!$updateUser){
    echo mysqli_error($updateUser);
  }

  mysqli_commit($updateUser);
}

$username = $_POST["name"];

if(isset($username)){
  $resQ = mysqli_query($db, "SELECT rooms_id as id from olymp.rooms, olymp.users WHERE olymp.users.name='$username' AND olymp.rooms.id = olymp.users.rooms_id");
  $room = mysqli_fetch_assoc($resQ);

  changeRoom($_SESSION['users_id'], $room['id']);

  header("Location: /chat/room.php?rooms_id={$room['id']}");
  die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Присоединение к чату</title>
  <link rel="stylesheet" href="/chat/css/bootstrap.min.css"/> 
</head>
<body>

<div align="center">
  <h2>Выберите пользователя, к которому хотите присоединиться</h2>
  <form action="/chat/join.php" method="post">
    <label for="name">
      Имя пользователя
      <input type="text" name="name" id="name">
    </label>
    <button class="btn btn-success" type="submit">Присоединиться</button>
  </form>
</div>
</body>
</html>