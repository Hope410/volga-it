<?php
require 'methods.php';

$name = $_POST['name'];
$email = $_POST['email'];

if(!isset($name)){
  echo success(false);
  die;
}

if(!isset($email)){
  echo success(false);
  die;
}

$user = insert('users', ['name' => $name, 'email' => $email]);

echo result(['id' => $user['id']]);