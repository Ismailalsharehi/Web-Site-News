<?php
namespace Model;

// class User
// {
//     public static function find($id)
//     {
//         $db = DB::connect(); // الاتصال بقاعدة البيانات
//         $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
//         $stmt->execute([$id]);
//         return $stmt->fetch(\PDO::FETCH_ASSOC); // يرجع بيانات المستخدم كمصفوفة
//     }
// }


require_once __DIR__ . "../../Core/Database/Connection.php";
use Core\Database;
use Model\Model;
use PDO;



 class Users extends Model{

  protected static $table = 'users';
  

  public  function getUserById($userId){
    $db= Database::connect();
    $stm = $db->prepare("SELECT* FROM users WHERE id = ?");
    $stm->execute([$userId]); //

    return $stm->fetch(\PDO::FETCH_ASSOC);
  }


}


