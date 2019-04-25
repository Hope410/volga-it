<?php
require 'connection.php';

function success($bool){
  return result(['success' => $bool]);
}

function result($mess){
  return json_encode($mess);
}

function makeQuery($row, $joiner){
  $arr = [];
  foreach ($row as $key => $value) {
    if(isset($value))
      $arr[] = "$key = '$value'";
  }

  return implode($joiner, $arr);
}

function execQuery($query){
  global $db;

  $resQ = mysqli_query($db, $query);
  
  if(!$resQ){
    echo mysqli_error($db);
  }

  return mysqli_fetch_assoc($resQ);
}

function map($arr, $callback){
  $result = [];
  foreach($arr as $key => $value){
    $result[] = $callback($value, $key, $arr);
  }

  return $result;
}

function getMany($table, $where) {
  global $db;

  $q = makeQuery($where, ' AND ');
  $w = $q != '' ? 'WHERE' : '';

  return execQuery($q);
}

function getOne($table, $where) {
  global $db;
  
  $q = makeQuery($where, ' AND ');
  $resQ = mysqli_query($db, "SELECT * FROM shashki.$table WHERE $q");
  
  if(!$resQ){
    echo mysqli_error($db);
  }

  return mysqli_fetch_assoc($resQ);
}

function quotes ($v){
  return "'${v}'";
}

function insert($table, $row){
  global $db;

  $keys = implode(', ', array_keys($row));
  $values = implode(', ', map(array_values($row), quotes));

  $insertQ = mysqli_query($db, "INSERT INTO shashki.$table ($keys) VALUES ($values)");
  if(!$insertQ){
    echo mysqli_error($db);
  }

  mysqli_commit($insertQ);

  $q = makeQuery($row, ' AND ');
  $one = execQuery("SELECT MAX(id) as id FROM shashki.$table WHERE $q");

  return $one;
}
