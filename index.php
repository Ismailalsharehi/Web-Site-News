<?php

spl_autoload_register(function ($class) {
    // استبدال الباك سلاشات بعلامة "/"
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // تحديد المسار للملف
    $file = __DIR__ . '/' . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        die("Class not found: $class");
    }
});
