<?php
    require_once 'init.php';

    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, [
                    'username'  =>  [
                                    'required'  =>  true,
                                    'min'   =>  2,
                                    'max'   =>  20,
                                    ],
                    'email' =>  [
                                    'required'  =>  true,
                                    'email' =>  true,
                                    'unique'    =>  'users'
                                    ],
                    'password' => [
                                    'required'  =>  true,
                                    'min'   =>  3
                                    ],
                    'password_again' => [
                                    'required'  =>  true,
                                    'matches'   => 'password'
                                    ]
                                    ]);
        if($validation->passed()) {
                    $user = new User;
                    $user->create([
                                'username'   => Input::get('username'),
                                'password'   =>  password_hash(Input::get('password'), PASSWORD_DEFAULT),
                                'email' =>  Input::get('email')
                                ]);
                    Session::flash('success', 'Успешный успех');
                    Redirect::to('login.php');
        } else {
                    Session::flash('danger',implode('<li>',$validation->errors()));
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
    	  <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
        <?php Session::display_flash_message('danger');?>
    	  <div class="form-group">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo Input::get('email')?>">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="email" name="username" placeholder="Ваше имя" value="<?php echo Input::get('username')?>">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password_again" placeholder="Повторите пароль">
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    	 <!-- <div class="checkbox mb-3">
    	    <label>
    	      <input type="checkbox"> Согласен со всеми правилами
    	    </label>
    	  </div>-->
    	  <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
        <div class="blankpage-footer text-center">
            Уже зарегистрированы?
            <a href="login.php" class="btn-link text-primary ml-auto ml-sm-0">Войти</a>
        </div>
    	  <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
    </form>
</body>
</html>
