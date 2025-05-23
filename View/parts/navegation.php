<?php


// require_once __DIR__ . '../../../../vendor/autoload.php';

use Core\Session;

Session::start();

use Core\Flash;
use Core\Database\Connection;
use Controllers\users;
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