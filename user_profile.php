<?php
require_once 'init.php';
    $id=$_GET['id'];
    $anotherUser=new User($id);
    $user=new User;


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
        <ul class="navbar-nav">
            <?php if(!$user->isLoggedIn()):?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Войти</a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="nav-link">Регистрация</a>
                </li>
            <?php else:?>
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
         <h1>Данные пользователя</h1>
         <table class="table">
           <thead>
             <th>ID</th>
             <th>Имя</th>
             <th>Дата регистрации</th>
             <th>Статус</th>
           </thead>
           <tbody>
             <tr>
               <td><?php echo $anotherUser->data()->id;?></td>
               <td><?php echo $anotherUser->data()->username?></td>
               <td><?php echo $anotherUser->data()->data_register?></td>
               <td><?php echo $anotherUser->data()->status;?></td>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
   </div>
</body>
</html>