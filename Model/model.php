<?php
namespace Model;
use Core\Database;
use PDO;


class Model{
  protected static $table = ''; // nam of table we want to passe it after


  public static find($id){
    $pdo = Database::connect();
    $stm = $pdo->prepare("SELECT* From ". static::$table. "WHERE id = :id");
    $stm->execute([':id' =>$id]);
    return $stm->fetchObject(static::class);
  }

  public static function all()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM " . static::$table);
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    //  فلترة Where
    public static function where($column, $value)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE $column = :column");
        $stmt->execute([':column'=>$value]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    //
    public static function create(array $data)
    {
        $pdo = Database::connect();

        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $stmt = $pdo->prepare("INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($data));

        return static::find($pdo->lastInsertId());
    }

    //تحديث سجل
    public static function update($id, array $data)
    {
        $pdo = Database::connect();

        $fields = implode(', ', array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $values = array_values($data);
        $values[] = $id;

        $stmt = $pdo->prepare("UPDATE " . static::$table . " SET $fields WHERE id = ?");
        $stmt->execute($values);

        return static::find($id);
    }

    //  حذف سجل
    public static function delete($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM " . static::$table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }
}