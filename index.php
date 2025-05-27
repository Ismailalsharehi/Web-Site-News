<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);


require("vendor/autoload.php");

Core\Session::start(); // <-- هنا بنستدعي كلاس السشن و نعمله ستارت
 // <-- هنا بنستدعي كلاس الفلاش و نعمله ستا
//

$router = new Core\Routers();

require 'routes.php'; // <-- هنا بنمرر الراوتر داخل الملف



//يستخرج المسار المطلوب من الرابط
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//يتحقق اذا في ميثود خاصه او يعتمد على الميثود العاديه
$methode = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];


//يبدا عملية التوجيه
$router->route($uri,$methode);

//dd($_SESSION['user']);
//يطعبع كل خصائص السرفر اسفل الصفحه

// dd($_SERVER);


