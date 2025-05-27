<?php

?>


<?php if(Core\Session::has('user')?? false):?>
  <?php if (Core\Session::get('user')['role']=== 'admin' ):?>
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
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">الرئيسية</a>
        </li> -->

        <!-- للمشرفين فقط -->

        <li class="nav-item"><a class="nav-link" href="/users_manage">المستخدمين</a></li>
        <li class="nav-item"><a class="nav-link" href="/categories_manage">التصنيفات</a></li>
        <!-- <li class="nav-item"><a class="nav-link" href="/admin/tags">الوسوم</a></li> -->


        <!-- للمشرفين والمحررين -->

        <li class="nav-item"><a class="nav-link" href="/article_manage">المقالات</a></li>
        <!-- <li class="nav-item"><a class="nav-link" href="/admin/comments">التعليقات</a></li> -->


        <!-- للكتاب (authors) -->

        <!-- <li class="nav-item"><a class="nav-link" href="/admin/my-articles">مقالاتي</a></li> -->

      </ul>
    </div>
  </div>
</nav>
  <?php endif; ?>
<?php endif; ?>
