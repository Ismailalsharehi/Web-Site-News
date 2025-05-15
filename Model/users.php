<!-- class User
{
    public static function find($id)
    {
        $db = DB::connect(); // الاتصال بقاعدة البيانات
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC); // يرجع بيانات المستخدم كمصفوفة
    }
} -->