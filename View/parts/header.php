<?php
use Core\Session;
use Core\Flash;

Session::start(); 

?>
<!DOCTYPE html> 
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الحدث - آخر الأخبار</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="font-family: 'Tajawal', sans-serif;">

<?php if (Flash::has('success')): ?>
    <div id = "flash-message" class="alert alert-success"><?= Flash::get('success') ?></div>
<?php elseif (Flash::has('error')): ?>
    <div id = "flash-message" class="alert alert-danger"><?= Flash::get('error') ?></div>
<?php elseif (Flash::has('warning')): ?>
    <div id = "flash-message" class="alert alert-warning"><?= Flash::get('warning') ?></div>
<?php elseif (Flash::has('info')): ?>
    <div id = "flash-message" class="alert alert-info"><?= Flash::get('info') ?></div>
<?php endif; ?>


<div class="container-fluid bg-light min-vh-100">

    
  <div class="d-flex justify-content-end p-3">
    <?php if (\Core\Session::isLoggedIn()): ?>
        <a href="/logout" class="btn btn-danger ms-2">
    <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
</a>

        
    <?php else: ?>
        <a href="/login" class="btn btn-success">
            <i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول
        </a>
    <?php endif; ?>
</div>
    <!-- بقية الصفحة -->



  <div class="container-fluid bg-light min-vh-100">