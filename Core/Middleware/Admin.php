

<?php
 use Core\Session;

class Admin{

  public static function handle(){


    if(!Session::has('user')){

      header("location: /login");
      exit;
    }

  }



}

// namespace core\Middleware ;
// class Admin {
//     public function handle(){
//         if(($_SESSION['user']['type'] != ("admin" || "manager")) ?? false){
//             header('location:/');
//             exit();
//         }
//     }

// }


