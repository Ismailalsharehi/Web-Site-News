<?php

// require_once __DIR__ . '../../../../vendor/autoload.php';

// use Core\Flash;  
// use Core\Session;
// use Controllers\categories;

// $error = Flash::get('error');
// $success = Flash::get('success'); 

// if ($error) {
//     echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
// }

// if ($success) {
//     echo '<div class="alert alert-success">' . htmlspecialchars($success) . '</div>';
// }
// 
?>


<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>



<div class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">الأقسام</h2>
    <div class="list-group">
      <div class="list-group-item">
        <?php foreach ($categories as $category): ?>
          <h5> <?= htmlspecialchars($category['name']) ?></h5>
          <p><strong>تاريخ الإنشاء:</strong> <?= htmlspecialchars($category['created_at']) ?></p>
          <a href="/categories_show?id=1" class="btn btn-primary">عرض التفاصيل</a>
          <?php endforeach; ?>
      </div>
    




    <!-- أضف المزيد من الأقسام هنا -->
    </div>
  </div>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>