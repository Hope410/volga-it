<?php
require 'methods.php';

$gamer_1 = $_POST['gamer_1'];
$gamer_2 = $_POST['gamer_2'];

if(!isset($gamer_1)){
  echo success(false);
  die;
}

if(!isset($gamer_2)){
  echo success(false);
  die;
}

function makeStates($game_id, $user_id, $pos){
  $alpha = 'abcdefghij';
  for($i = 0; $i < 10; $i++){
    for($j = 1; $j <= 10; $j++){
      if(($pos == 0 && $j > 0 && $j <= 4) || 
         ($pos == 1 && $j > 6 && $j <= 10)){

        if(($i % 2 == 0 && $j % 2 == 1) || ($i % 2 == 1 && $j % 2 == 0)){
          insert('states', [
            'letter' => $alpha[$i], 
            'number' => $j, 
            'games_id' => $game_id, 
            'gamer_id' => $user_id]);
        }
      }
    }
  }
}

$game = insert('games', ['gamer_1' => $gamer_1, 'gamer_2' => $gamer_2]);

makeStates($game['id'], $gamer_1, 0);
makeStates($game['id'], $gamer_2, 1);

echo result(['id' => $game['id']]);