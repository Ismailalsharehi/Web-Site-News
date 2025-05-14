<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>

<!-- // app/Views/articles/show.php

// Include the default layout (header, footer, navigation)
// The $data variable is passed from the ArticleController
// $data["title"], $data["description"], $data["article"], $data["comments"], $data["tags"], $data["categories"] (for nav) -->

 
<div class="container mt-5">

  <h1>عنوان المقال: أهمية التقنية في العصر الحديث</h1>

  <p class="text-muted">
    الكاتب: <strong>إسماعيل أحمد</strong> |
    التصنيف: <span>تقنية</span> |
    الحالة: <span>منشور</span> |
    <span class="badge bg-warning text-dark">مقال مميز</span>
    <br>
    التاريخ: 2025-05-13 |
    عدد المشاهدات: 1234
  </p>

  <!-- صورة المقال -->
  <img src="/uploads/articles/tech_article.jpg" class="img-fluid rounded mb-3" alt="صورة المقال">

  <!-- فيديو مدمج -->
  <div class="mb-4">
    <iframe width="100%" height="400" src="https://www.youtube.com/embed/ysz5S6PUM-U" frameborder="0" allowfullscreen></iframe>
  </div>

  <!-- الملخص -->
  <div class="alert alert-info">
    في هذا المقال، نستعرض كيف أصبحت التقنية جزءًا لا يتجزأ من حياتنا اليومية، وتأثيرها في مختلف المجالات.
  </div>

  <!-- المحتوى الكامل -->
  <div class="content lead">
    <p>
      لا شك أن التقنية غيّرت طريقة تواصلنا، وعملنا، وتعلمنا. فقد أصبحت الهواتف الذكية، والذكاء الاصطناعي، والحوسبة السحابية، جزءًا من البنية الأساسية لعالمنا الحديث.
    </p>
    <p>
      وفي المستقبل، نتوقع تطورات أكبر، مثل الواقع الافتراضي، والتحكم عبر الذكاء، مما سيفتح آفاقًا جديدة في التعليم، والصحة، والاقتصاد.
    </p>
  </div>

</div>



<?php require('../../parts/footer.php') ?>