<?php

namespace core;

class Session{

public static function start():void{
  if(session_status()=== PHP_SESSION_NONE){
    session_start();

  }
}

public static function set (string $key, mixed $value):void{

  self::start();
  $_SESSION[$key] =$value;
}

public static function get(string $key, mixed $defult = null):mixed{
  self::start();
  return $_SESSION[$key]?? $defult;
}

public static function has(string $key):bool{
  self::start();
  return isset($_SESSION[$key]);
}


public static function remove(string $key):void{
  self::start();
  unset($_SESSION[$key]); 
}

public static function destroy():void{
self::start();
session_unset();
session_destroy();
}

public static function all():array{
  self::start();
  return $_SESSION;
}

 
}