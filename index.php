<?php
require_once 'init.php';
    $users=Database::getInstance()->query('SELECT * FROM users')->results();
    $loggingStatus=new User;



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">User Management</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Главная</a>
          </li>
        </ul>
<!--If user already logged in, we will show Profile and Exit links:-->
        <ul class="navbar-nav">
        <?php if(!$loggingStatus->isLoggedIn()):?>
          <li class="nav-item">
            <a href="login.php" class="nav-link">Войти</a>
          </li>
          <li class="nav-item">
              <a href="register.php" class="nav-link">Регистрация</a>
          </li>
            <?php else:?>
          <li class="nav-item">
              <a href="profile.php" class="nav-link">Профиль</a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">Выйти</a>
          </li>
        <?php endif;?>
        </ul>
      </div>
    </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <h1 class="display-4">Привет, мир!</h1>
          <p class="lead">Это дипломный проект по разработке на PHP. На этой странице список наших пользователей.</p>
          <hr class="my-4">
          <p>Чтобы стать частью нашего проекта вы можете пройти регистрацию.</p>
          <a class="btn btn-primary btn-lg" href="register.php" role="button">Зарегистрироваться</a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Дата</th>
            </tr>
          </thead>
        <?php foreach ($users as $user):?>
          <tbody>
            <tr>
              <td><?php echo $user->id;?></td>
              <td><a href="user_profile.php?id=<?php echo $user->id;?>"><?php echo $user->username;?></a></td>
              <td><?php echo $user->email;?></td>
              <td><?php echo $user->data_register;?></td>
            </tr>
          </tbody>
        <?php endforeach;?>
        </table>
      </div>
    </div>
  </div>
</body>
</html>