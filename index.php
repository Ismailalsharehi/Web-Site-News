<?php
//يبدا جلسة المستخدم
// session_start();

require("vendor/autoload.php");
spl_autoload_register(function ($class) {
    $class =str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require "{$class}.php";
});
