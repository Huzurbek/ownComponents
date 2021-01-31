<?php
    require_once '../init.php';
    $user=new User;
    $another=new User($_GET['id']);
    if(!$user->hasPermissions('admin')){
        Redirect::to('../login.php');
    }
    //$id=$_GET['id'];
    //$user=Database::getInstance()->get('users',['id','=',$id])->first();
    //Update is starting:
    $validate = new Validate();
    $validate->check($_POST, [
        'username'  =>  ['required'=>true, 'min'=>2],
        'status'=>['required'=>true]
    ]);

    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            if($validate->passed()) {
                    $another->update(['username'=> Input::get('username'),
                        'status'=>Input::get('status')
                    ],$_GET['id']);
                Session::flash('info', 'Профиль обновлен');
                Redirect::to("edit.php?id=".$_GET['id']);
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
              <a class="nav-link" href="../index.php">Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Управление пользователями</a>
            </li>
          </ul>

          <ul class="navbar-nav">
            <li class="nav-item">
              <li class="nav-item">
                  <a href="../user_profile.php?id=<?php echo $another->data()->id;?>" class="nav-link">Данные пользователя</a>
              </li>
              <a href="../logout.php" class="nav-link">Выйти</a>
            </li>
          </ul>
        </div>
    </nav>

   <div class="container">
     <div class="row">
       <div class="col-md-8">
         <h1>Профиль пользователя - <?php echo $another->data()->username;?></h1>

         <?php Session::display_flash_message('info');?>
         <?php Session::display_flash_message('danger');?>

         <form action="" class="form" method="post">
           <div class="form-group">
             <label for="username">Имя</label>
             <input type="text" id="username" class="form-control" name="username" value="<?php echo $another->data()->username;?>">
           </div>
           <div class="form-group">
             <label for="status">Статус</label>
             <input type="text" id="status" class="form-control" name="status" value="<?php echo $another->data()->status;?>">
           </div>
             <input type="hidden" name="token" value="<?php echo Token::generate();?>">
           <div class="form-group">
             <button class="btn btn-warning" type="submit">Обновить</button>
           </div>
         </form>


       </div>
     </div>
   </div>
</body>
</html>