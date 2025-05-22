<?php
namespace Controllers\categories;

require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_categories'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $slug = htmlspecialchars($_POST['slug']);

    try {
        $conn = Connection::connect();

        $stmt = $conn->prepare("UPDATE categories SET name = :name, description = :description, slug = :slug WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            Flash::set('success', 'تم تحديث التصنيف بنجاح');
        } else {
            Flash::set('error', 'فشل في تحديث التصنيف');
        }

        header('Location: ../../View/pages/categories/index_view.php');
        exit;

    } catch (PDOException $e) {
        Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
        header('Location: ../../View/pages/categories/index_view.php');
        exit;
    }
}
