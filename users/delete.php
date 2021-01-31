<?php
    require_once '../init.php';
    $id=$_GET['id'];
    $admin=new User;
    $user=new User($id);

    if($admin->data()->id==$user->data()->id){
        $user->deleteUser(['id','=',$user->data()->id]);
        Redirect::to('../register.php');
    }
        $user->deleteUser(['id','=',$user->data()->id]);
        Redirect::to('index.php');