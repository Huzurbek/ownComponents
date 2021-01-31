<?php
require_once 'init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate->check($_POST, [
            'email' => ['required'=>true,'email'=>true],
            'password'  =>  ['required'=>true]
        ]);

        if($validate->passed()) {
            $user = new User;
            $remember = (Input::get('remember')) === 'on' ? true : false;

            $login = $user->login(Input::get('email'), Input::get('password'), $remember);

            if($login) {
                Redirect::to('profile.php');
            } else {
                Session::flash('info',' Логин или пароль неверны');
            }
        } else {
            Session::flash('danger',implode('<li>',$validate->errors()));
        }
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post">
    	  <img class="mb-4" src="images/apple-touch-icon.png" alt="" width="72" height="72">
    	  <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
        <?php Session::display_flash_message('success');?>
        <?php Session::display_flash_message('danger');?>
        <?php Session::display_flash_message('info');?>
    	  <div class="form-group">
          <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo Input::get('email')?>">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" placeholder="Пароль" name="password">
        </div>
    	  <div class="checkbox mb-3">
    	    <label>
    	      <input type="checkbox" name="remember"> Запомнить меня
    	    </label>
    	  </div>
        <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    	  <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        <div class="blankpage-footer text-center">
            Нет аккаунта?<a href="register.php" class="btn-link text-primary ml-auto ml-sm-0">Зарегистрироваться</a>
        </div>
         <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
    </form>
</body>
</html>
