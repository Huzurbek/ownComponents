<?php
    require_once '../init.php';
    $user=new User;

    $another=new User($_GET['id']);


    if($user->data()->id==$another->data()->id) {
        $another->update(['group_id' => 1],$_GET['id']);
        Redirect::to('../register.php');
    }elseif (!$another->hasPermissions('admin')){
        $another->update(['group_id' => 2], $_GET['id']);
        Redirect::to('index.php');
    }else{
        $another->update(['group_id'=>1],$_GET['id']);
        Redirect::to('index.php');
    }

