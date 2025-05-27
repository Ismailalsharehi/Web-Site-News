<?php
namespace Core;
 
use Core\Session; // Import the Session class

class Flash {

  public static function set(string $key, string $message):void{

    Session::start(); //chek if session is started
    $_SESSION['_flash'][$key] = $message; // set the message in the session
  }

  public static function get(string $key): ?string{
    Session::start();
    

    if(isset($_SESSION['_flash'][$key])){ // check if the message is set
      $message = $_SESSION['_flash'][$key]; // get the message
      unset($_SESSION['_flash'][$key]); // remove the message from the session
      return $message; // return the message
    }
      
    return null;
  }

  public static function has(string $key):bool{
    Session::start();
    return isset($_SESSION['_flash'][$key]); // check if the message exists
  }
 
}
