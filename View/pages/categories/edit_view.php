<?php
// require_once __DIR__ . '../../../../vendor/autoload.php';

use Core\Session;
  use Core\Flash;
use Controllers\categories;

// $success = new Flash();
$error = Flash::get('error');
$success = Flash::get('success');
// var_dump($category);

if ($error) {
  echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
elseif ($success) {
    echo '<div class="alert alert-success">' . htmlspecialchars($error) . '</div>';
  }


  
  // var_dump($categories['slug']);
?>

<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>



<div class="container my-5">
  <div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
      <h5 class="mb-0">تعديل القسم</h5>
    </div>
    <div class="card-body">
      <form action="update.php" method="POST">
        <!-- حقل مخفي لرقم القسم (id) -->
         
        <input type="hidden" name="id" value=" <?= htmlspecialchars($category['id']) ?>">

        <!-- اسم القسم -->
        <div class="mb-3">
          <label for="name" class="form-label">اسم القسم</label>
          <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category['name'])?>" required>
        </div>

        <!-- slug -->
        <div class="mb-3">
          <label for="slug" class="form-label">الاسم في الرابط (slug)</label>
          <input type="text" class="form-control" id="slug" name="slug" value="<?= htmlspecialchars($category['slug'])?> "required>
        </div>

        <!-- الوصف -->
        <div class="mb-3">
          <label for="description" class="form-label">الوصف</label>
          <textarea class="form-control" id="description" name="description" rows="4"> <?= htmlspecialchars($category['description'])?></textarea>
        </div>

        <!-- أزرار -->
        <button type="submit" class="btn btn-primary" name="update_categories">تحديث</button>
        <a href="#" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>


<?php require_once __DIR__ . '../../../parts/footer.php'; ?>