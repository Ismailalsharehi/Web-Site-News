<?php
use core\Session;

class Flash{

  public static function set(string $key, string $message):void{

    Session::start(); //chek if session is started
    $_SESSION['_flash'][$key] =$message; // set the message in the session
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


/// we can use in the controller likes that
// forexample if the ussser is not found then
// Flsh::set('error', 'User not found');
// and in the view we can use it like this
// if(Flash::has('error')){
//   echo Flash::get('error');
// }

//

// if (Flash::has('success')) {
//     echo "<div class='alert alert-success'>" . Flash::get('success') . "</div>";
// } else if (Flash::has('error')) {
//     echo "<div class='alert alert-danger'>" . Flash::get('error') . "</div>";
// } else if (Flash::has('warning')) {
//     echo "<div class='alert alert-warning'>" . Flash::get('warning') . "</div>";
// } else if (Flash::has('info')) {
//     echo "<div class='alert alert-info'>" . Flash::get('info') . "</div>";
// } else if (Flash::has('primary')) {
//     echo "<div class='alert alert-primary'>" . Flash::get('primary') . "</div>";
// } else if (Flash::has('secondary')) {
//     echo "<div class='alert alert-secondary'>" . Flash::get('secondary') . "</div>";
// } else if (Flash::has('light')) {
//     echo "<div class='alert alert-light'>" . Flash::get('light') . "</div>";
// } else if (Flash::has('dark')) {
//     echo "<div class='alert alert-dark'>" . Flash::get('dark') . "</div>";
// }
