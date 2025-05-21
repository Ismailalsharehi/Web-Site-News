<?php

require_once __DIR__ . '../../../../vendor/autoload.php';
// require_once __DIR__ . '../../../../index.php';

use Core\Flash;
use Core\Database\Connection;
use Controllers\articles;

$error = Flash::get('error');
$success = Flash::get('success');

if ($error) {
  echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
} elseif ($success) {
  echo '<div class="alert alert-success">' . htmlspecialchars($success) . '</div>';
}


require('../../../Controllers/articles/manage.php');

// var_dump($articles);
// echo '<pre>'; 
//  var_dump($articles);

// echo '</pre>';
?>

<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>

<div class="bg-light">
  <div class="container mt-5">

    <!-- العنوان وزر الإضافة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4>إدارة المقالات</h4>
      <a href="./create_article.php" class="btn btn-success">
        + <i class="bi bi-file-earmark-plus"></i> إضافة مقال جديد
      </a>
    </div>

    <!--  البحث والفلترة -->
    <form method="GET" class="row g-3 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="🔍 ابحث بالعنوان أو الكاتب..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
      </div>

      <div class="col-md-3">
        <select name="category_id" class="form-select">
          <option value="">جميع التصنيفات</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($_GET['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-3">
        <select name="status" class="form-select">
          <option value="">كل الحالات</option>
          <option value="published" <?= ($_GET['status'] ?? '') === 'published' ? 'selected' : '' ?>>منشور</option>
          <option value="draft" <?= ($_GET['status'] ?? '') === 'draft' ? 'selected' : '' ?>>مسودة</option>
          <option value="archived" <?= ($_GET['status'] ?? '') === 'archived' ? 'selected' : '' ?>>مؤرشف</option>
        </select>
      </div>

      <div class="col-md-2">
        <button class="btn btn-primary w-100" type="submit">بحث</button>
      </div>
    </form>

    <!-- جدول المقالات -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle text-center bg-white">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>الصورة</th>
            <th>العنوان</th>
            <th>التصنيف</th>
            <th>الكاتب</th>
            <th>الحالة</th>
            <th>مميز؟</th>
            <th>المشاهدات</th>
            <th>تاريخ النشر</th>
            <th>التحكم</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($articles as $index => $article): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td>
                <?php if (!empty($article['image_path'])): ?>
                  <img src="images/<?= $article['image_path'] ?>" alt="صورة المقال" style="max-width: 200px;">
                <?php else: ?>
                  <span class="text-muted">لا توجد صورة</span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($article['title']) ?></td>
              <td><?= htmlspecialchars($article['category_name']) ?></td>
              <td><?= htmlspecialchars($article['author_name']) ?></td>
              <td>
                <span class="badge bg-<?= $article['status'] === 'published' ? 'success' : ($article['status'] === 'draft' ? 'secondary' : 'danger') ?>">
                  <?= $article['status'] ?>
                </span>
              </td>
              <td>
                <?= $article['is_featured'] ? '<span class="badge bg-warning text-dark">✔</span>' : '—' ?>
              </td>
              <td><?= $article['views_count'] ?></td>
              <td><?= $article['published_at'] ? date('Y-m-d', strtotime($article['published_at'])) : '—' ?></td>
              <td>

                <div>
                  <form action="../../../Controllers/articles/edit.php" method="GET">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
                    <button type="submit" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i> تعديل
                    </button>
                  </form>
                </div>

                <div>
                  <form action="../../../Controllers/articles/show.php" method="GET">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
                    <button type="submit" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i> عرض
                    </button>
                  </form>
                </div>

                <div>
                  <form action="../../../Controllers/articles/delete.php" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');" class="d-inline">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger">🗑 حذف</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if (empty($articles)): ?>
      <div class="alert alert-warning text-center">لا توجد نتائج مطابقة للبحث.</div>
    <?php endif; ?>

    <!-- التنقل بين الصفحات  -->
    <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#">السابق</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">التالي</a></li>
      </ul>
    </nav>

  </div>
</div>

<?php require('../../parts/footer.php') ?>