<?php


use Core\Session;

Session::start();

use Core\Flash;
use Core\Database\Connection;
use Controllers\users;



// $usere = $_SESSION['user_data'];
// $user = Session::get('user_data'); 



?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand fs-4 fw-bold text-white" href="#">ما وراء الحدث</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">الرئيسية </a></li>
        <li class="nav-item"><a class="nav-link" href="/list?slug=politics">سياسية</a></li>
        <li class="nav-item"><a class="nav-link" href="/list?slug=opinion">مقالات</a></li>
        <li class="nav-item"><a class="nav-link" href="/list?slug=economy">اقتصاد</a></li>
        <li class="nav-item"><a class="nav-link" href="/list?slug=technology">تكنولوجيا</a></li>
        <li class="nav-item"><a class="nav-link" href="/list?slug=culture-arts">ثقافة وفنون</a></li>
      </ul>
    </div>
  </div>
</nav>