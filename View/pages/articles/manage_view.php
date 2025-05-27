<?php


// require('../../../Controllers/articles/manage.php');

?>

<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>


<div class="bg-light py-5">
  <div class="container">
  
    

    <!-- عنوان الصفحة وزر الإضافة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold"> إدارة المقالات</h2>
      <a href="/article_create" class="btn btn-success btn-lg shadow">
         <i class="bi bi-file-earmark-plus"></i> إضافة مقال
      </a>
    </div>

    <!-- ملخص -->
    <div class="alert alert-info">
      <strong> إجمالي المقالات:</strong> <?= htmlspecialchars($articles_count) ?>
    </div>

    <!-- نموذج البحث والفلترة -->
    <form method="GET" class="row g-3 align-items-end mb-4">
      <div class="col-md-4">
        <label class="form-label">ابحث</label>
        <input type="text" name="search" class="form-control" placeholder="🔍 العنوان أو الكاتب..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">التصنيف</label>
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
        <label class="form-label">الحالة</label>
        <select name="status" class="form-select">
          <option value="">كل الحالات</option>
          <option value="published" <?= ($_GET['status'] ?? '') === 'published' ? 'selected' : '' ?>>منشور</option>
          <option value="draft" <?= ($_GET['status'] ?? '') === 'draft' ? 'selected' : '' ?>>مسودة</option>
          <option value="archived" <?= ($_GET['status'] ?? '') === 'archived' ? 'selected' : '' ?>>مؤرشف</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100" type="submit">
          <i class="bi bi-search"></i> بحث
        </button>
      </div>
    </form>

    <!-- جدول المقالات -->
    <div class="table-responsive shadow-sm">
      <table class="table table-hover align-middle text-center bg-white border rounded">
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
                  <img src="../../views/media/images/<?= $article['image_path']; ?>" alt="صورة" class="img-thumbnail" style="max-width: 80px;">
                <?php else: ?>
                  <span class="text-muted">لا توجد</span>
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
                <div class="btn-group" role="group">

                  <form action="/article_show" method="GET">
                    <input type="hidden" name="slug" value="<?= htmlspecialchars($article['slug']) ?>">
                    <!-- <input type="hidden" name="_method" value="DELETE"> -->
                    <button type="submit" class="btn btn-sm btn-outline-primary" title="عرض"><i class="bi bi-eye"></i></button>
                  </form>

                  <form action="/article_edit" method="GET">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
                
                    <button type="submit" class="btn btn-sm btn-outline-warning" title="تعديل"><i class="bi bi-pencil-square"></i></button>
                  </form>

                  <form action="/article_destroy" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if (empty($articles)): ?>
      <div class="alert alert-warning text-center mt-4">لا توجد نتائج.</div>
    <?php endif; ?>

    <!-- التنقل بين الصفحات -->
    <nav class="mt-4">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#">السابق</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">التالي</a></li>
      </ul>
    </nav>
  </div>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>
