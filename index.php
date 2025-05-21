<?php
//يبدا جلسة المستخدم
// session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


require("vendor/autoload.php");
spl_autoload_register(function ($class) {
    $class =str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require "{$class}.php";
});

// if (preg_match('/^\/views\/media\/images\/(.+)$/', $_SERVER['REQUEST_URI'], $matches)) {
//     $image = __DIR__ . '/views/media/images/' . $matches[1];
//     if (file_exists($image)) {
//         header("Content-Type: image/jpeg"); // أو حسب نوع الصورة
//         readfile($image);
//         exit;
//     }
// }


use Core\Routers;

require 'Core/Routers.php';

$router = new Routers();

require 'routes.php'; // <-- هنا بنمرر الراوتر داخل الملف

//ينشاء كلاس الروتر و يستدعي  الموجه


//يستدعي كل المسارات من ملف routes.php
// foreach ($routes as $route) {
//     $router->add($route['method'], $route['uri'], $route['action']);
// }

//يستخرج المسار المكلوب من الرابط
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//يتحقق اذا في ميثود خاصه او يعتمد على الميثود العاديه
$methode = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];


//يبدا عملية التوجيه
$router->route($uri,$methode);

//dd($_SESSION['user']);
//يطعبع كل خصائص السرفر اسفل الصفحه

// dd($_SERVER);


