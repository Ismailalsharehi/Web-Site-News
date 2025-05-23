<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Core\Session;
use Core\Flash;

if (headers_sent($file, $line)) {
  // die("Headers already sent in $file on line $line");
}
var_dump(Session::get('user_data'));
// check if the user is logged in
if (!Session::has('user')) {
  Flash::set('error', 'يجب تسجيل الدخول للوصول إلى هذه الصفحة.');
  header('Location: ../index.php');
  exit;
}
// check if the user is admin
if (Session::get('user')['role'] !== 'admin') {
  Flash::set('error', 'ليس لديك إذن للوصول إلى هذه الصفحة.');
  header('Location:index.php');
  exit;
}
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">لوحة التحكم</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- رابط الرئيسية يظهر للجميع -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/admin">الرئيسية</a>
        </li>

        <!-- للمشرفين فقط -->

        <li class="nav-item"><a class="nav-link" href="../../../View/pages/users/manage_view.php">المستخدمين</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/categories">التصنيفات</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/tags">الوسوم</a></li>


        <!-- للمشرفين والمحررين -->

        <li class="nav-item"><a class="nav-link" href="/admin/articles">المقالات</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/comments">التعليقات</a></li>


        <!-- للكتاب (authors) -->

        <li class="nav-item"><a class="nav-link" href="/admin/my-articles">مقالاتي</a></li>

      </ul>
    </div>
  </div>
</nav>