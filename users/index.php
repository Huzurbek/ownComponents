<?php
    require_once '../init.php';
    $user=new User;
    if(!$user->hasPermissions('admin')){
        Redirect::to('../login.php');
        }

        $users=Database::getInstance()->query('SELECT * FROM users')->results();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
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
            <a class="nav-link" href="#">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Управление пользователями</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <li class="nav-item">
              <a href="../profile.php" class="nav-link">Профиль</a>
            </li>
            <a href="../logout.php" class="nav-link">Выйти</a>
          </li>
        </ul>
      </div>
  </nav>

    <div class="container">
      <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Действия</th>
            </tr>
          </thead>
            <?php foreach ($users as $user):?>
          <tbody>
            <tr>
              <td><?php echo $user->id;?></td>
              <td><?php echo $user->username;?></td>
              <td><?php echo $user->email;?></td>
              <td>

                <a href="../user_profile.php?id=<?php echo $user->id;?>" class="btn btn-info">Посмотреть</a>
                <a href="edit.php?id=<?php echo $user->id;?>" class="btn btn-warning">Редактировать</a>
                <a href="delete.php?id=<?php echo $user->id;?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">Удалить</a>
                  <?php if($user->group_id==2):?>
                      <a href="admin.php?id=<?php echo $user->id;?>" class="btn btn-danger">Разжаловать</a>
                  <?php else:?>
                      <a href="admin.php?id=<?php echo $user->id;?>" class="btn btn-success">Назначить администратором</a>
                  <?php endif;?>
              </td>
            </tr>
          </tbody>
            <?php endforeach;?>
        </table>
      </div>
    </div>  
  </body>
</html>
