<?php
require 'methods.php';

$row = [
  'name' => $_GET['name'],
  'email' => $_GET['email']
];

echo result(getMany('users', $row));