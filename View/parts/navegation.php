<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-danger" href="#">الحدث</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="#">العربية</a></li>
        <li class="nav-item"><a class="nav-link" href="#">العالم</a></li>
        <li class="nav-item"><a class="nav-link" href="#">الاقتصاد</a></li>
        <li class="nav-item"><a class="nav-link" href="#">الرياضة</a></li>
        <li class="nav-item"><a class="nav-link" href="#">فيديو</a></li>
        <li class="nav-item"><a class="nav-link" href="#">اتصل بنا</a></li>
      </ul>
    </div>
  </div>
</nav> -->

<!-- 
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold" href="#">الحدث</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="#">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="#">أخبار عربية</a></li>
                <li class="nav-item"><a class="nav-link" href="#">أخبار دولية</a></li>
                <li class="nav-item"><a class="nav-link" href="#">رياضة</a></li>
                <li class="nav-item"><a class="nav-link" href="#">اقتصاد</a></li>
            </ul>
        </div>
    </div>
</nav> -->



<?php 


// require_once __DIR__ . '../../../../vendor/autoload.php';

use Core\Flash;
use Core\Database\Connection;
use Controllers\users;
use Core\Session;
// Session::start();
// session_start();


// $usere = $_SESSION['user_data'];
// $user = Session::get('user_data'); 



?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold text-white" href="#">الحدث</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

        
        

         
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="../../../View/pages/users/manage_view.php">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="../../../View/pages/users/index_view.php">أخبار عربية</a></li>
                <li class="nav-item"><a class="nav-link" href="#">أخبار دولية</a></li>
                <li class="nav-item"><a class="nav-link" href="#">رياضة</a></li>
                <li class="nav-item"><a class="nav-link" href="#">اقتصاد</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold" href="#">النبأ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="#">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="#">سياسة</a></li>
                <li class="nav-item"><a class="nav-link" href="#">اقتصاد</a></li>
                <li class="nav-item"><a class="nav-link" href="#">ثقافة</a></li>
                <li class="nav-item"><a class="nav-link" href="#">تكنولوجيا</a></li>
            </ul>
        </div>
    </div>
    

</nav> -->