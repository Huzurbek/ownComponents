<?php

class Session {
//Put Sesssion:
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }
//Checking Existing of Session:
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }
//Delete Session:
    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }
//Get Session:
    public static function get($name) {
        return $_SESSION[$name];
    }
//Flash message:
    public static function flash($name, $string = '') {
        if(self::exists($name) && self::get($name) !== '') {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }
//Display flash message:
    public static function display_flash_message($name){
        if(self::exists($name)){
            if($name=='danger'){
                echo "<div class=\"alert alert-{$name} text-{$name}\" role=\"alert\"><ul><li>{$_SESSION[$name]}</li></ul></div>";
                self::delete($name);
            }else{
                echo "<div class=\"alert alert-{$name} text-{$name}\" role=\"alert\">{$_SESSION[$name]}</div>";
                self::delete($name);
               
            }
        }
    }



}