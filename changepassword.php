<?php
    require_once 'init.php';

    $user = new User;
    if(!$user->isLoggedIn()){
        Redirect::to('login.php');
    }
    $admin=$user->hasPermissions('admin');
    $validate = new Validate();
    $validate->check($_POST, [
        'current_password'  =>  ['required'=>true, 'min' => 3],
        'new_password'  =>  ['required'=>true, 'min' => 3],
        'new_password_again'  =>  ['required'=>true, 'min' => 3, 'matches'  =>  'new_password'],
    ]);

    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            if($validate->passed()) {
                if(password_verify(Input::get('current_password'), $user->data()->password)) {
                    $user->update(['password'   =>  password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
                    Session::flash('success', 'Password has been updated.');
                    Redirect::to('changepassword.php');
                } else {
                    Session::flash('info', 'Invalid current password');
                     }
            } else {
                Session::flash('danger',implode('<li>',$validate->errors()));
            }
        }
    }
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
          <li class="nav-item">
              <!--If user is admin, we will show Manage users links:-->
              <?php if($admin):?>
                  <a class="nav-link" href="users/index.php">Управление пользователями</a>
              <?php endif;?>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <li class="nav-item">
              <a href="profile.php" class="nav-link">Профиль</a>
            </li>
            <a href="logout.php" class="nav-link">Выйти</a>
          </li>
        </ul>
      </div>
    </nav>

   <div class="container">
     <div class="row">
       <div class="col-md-8">
         <h1>Изменить пароль</h1>
           <?php Session::display_flash_message('success'); ?>
           <?php Session::display_flash_message('info'); ?>
           <?php Session::display_flash_message('danger'); ?>

           <ul>
           <li><a href="profile.php">Изменить профиль</a></li>
         </ul>
         <form action="" class="form" method="post">
           <div class="form-group">
             <label for="current_password">Текущий пароль</label>
             <input type="password" id="current_password" name='current_password' class="form-control">
           </div>
           <div class="form-group">
             <label for="current_password">Новый пароль</label>
             <input type="password" id="current_password" name='new_password' class="form-control">
           </div>
           <div class="form-group">
             <label for="current_password">Повторите новый пароль</label>
             <input type="password" id="current_password" name='new_password_again' class="form-control">
           </div>
             <input type="hidden" name="token" value="<?php echo Token::generate();?>">
           <div class="form-group">
             <button class="btn btn-warning" type="submit">Изменить</button>
           </div>
         </form>
       </div>
     </div>
   </div>
</body>
</html>