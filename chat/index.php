<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cоздать чат</title>
  <link rel="stylesheet" href="/chat/css/bootstrap.min.css"/> 
</head>
<body>

<div align="center">
  <h2>Вход</h2>
  <form action="/chat/createChat.php" method="get">
    <label for="name">
      Имя пользователя
      <input type="text" name="name" id="name">
    </label>
    <button class="btn btn-success" type="submit">Начать чат</button>
  </form>
</div>

</body>
</html>