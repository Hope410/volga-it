<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Страница чата</title>

  <link rel="stylesheet" href="/chat/css/bootstrap.min.css"/> 
  <link rel="stylesheet" href="/chat/css/style.css"/> 

</head>
<body>
<div>
<?php
require 'connection.php';
session_start();

$rooms_id = $_GET['rooms_id'];
$users_id = $_SESSION['users_id'];

$res = mysqli_query($db, "SELECT * FROM olymp.users WHERE id='$users_id'");
if(!$res){
  header("Location: /chat/index.php");
}

$user = mysqli_fetch_assoc($res);

echo "<h3 align=\"center\">Добро пожаловать в Чат №$rooms_id, {$user['name']} </h3>";

?>
  <div class="card history">
    <div class="card-header">
      Чат
    </div>
    <div class="card-body">
      <div class="main">
      </div>
      <div class="input-message">
        <label for="inputMessage">
          Введите сообщение:
          <input type="text" name="inputMessage" id="inputMessage">
        </label>
        <button id="send" class="btn btn-success" >Отправить!</button>
      </div>
    </div>
  </div>
</div>

  <script src="/chat/js/jquery.min.js"></script>
  <script>
    $('#send').click(sendMessage);

    function newMessage(name, text, date){
      var message = document.createElement('div');
      message.setAttribute('class', 'message');
      message.setAttribute('align', 'left');
      
      message.innerHTML = "<span class=\"username\">"+name+":</span><span class=\"message-text\">"+text+"</span><br><span class=\"message-date\">"+date+"</span>"
      return message;
    }

    window.onload = function() {
      setInterval(function(){
        $.ajax({
          method: 'GET',
          url: '/chat/getHistory.php',
          data: {
            rooms_id: <?php echo $rooms_id . "\n";?>
          },
          success: function(res) {
            // console.log(res);
            $('.main').empty();
            
            for(var i = 0; i < res.length; i++){
              // console.log(newMessage(res[i].name, res[i].text))
              $('.main').append(newMessage(res[i].name, res[i].text, res[i].date));
            }
          }
        })
      }, 1000);
    }

    function sendMessage(){
      var text = document.getElementById('inputMessage').value;
      $.ajax({
        method: 'POST',
        url: '/chat/sendMessage.php',
        data: {
          text: text,
          users_id: <?php echo $users_id . "\n";?>,
          rooms_id: <?php echo $rooms_id . "\n";?>
        },
        success: function(res) {
          console.log(res);
          // $('.main').empty();
          
          // for(var i = 0; i < res.length; i++){
          //   // console.log(newMessage(res[i].name, res[i].text))
          //   $('.main').append(newMessage(res[i].name, res[i].text));
          // }
        }
      })
    }
  </script>
</body>
</html>