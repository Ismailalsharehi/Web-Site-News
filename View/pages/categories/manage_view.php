<?php 
// echo '<pre>';
// var_dump($categories);
// echo '</pre>';

?>

<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>

<div class="bg-light py-5">
  <div class="container">

    <!-- عرض رسائل التنبيه -->
    
    <!-- العنوان وزر الإضافة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4>إدارة الأقسام</h4>
      <a href="/categories_create" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> إضافة قسم جديد
      </a>
    </div>

    <div class="alert alert-info">
      إجمالي الأقسام: <strong><?= htmlspecialchars($category_count)?></strong>

      
    </div>

    <!-- البحث -->
    <form method="GET" class="row g-3 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="🔍 ابحث باسم القسم..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100" type="submit">بحث</button>
      </div>
    </form>

    <!-- جدول الأقسام -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle text-center bg-white">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>الاسم في الرابط (Slug)</th>
            <th>تاريخ الإضافة</th>
            <th>التحكم</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $index => $cat): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($cat['name']) ?></td>
                <td><?= htmlspecialchars($cat['slug']) ?></td>
                <td><?= htmlspecialchars($cat['created_at']) ?></td>
                <td>
                  <div class="d-flex justify-content-center gap-1">
                    <a href="/categories_show?id=<?= $cat['id'] ?>" class="btn btn-sm btn-info text-white">
                      <i class="bi bi-eye"></i> عرض
                    </a>
                    <a href="/categories_edit?id=<?= $cat['id'] ?>" class="btn btn-sm btn-warning" name="edit">
                      <i class="bi bi-pencil-square"></i> تعديل
                    </a>
                    <form action="/categories_destroy" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟');">
                      <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-sm btn-danger" name="delete">
                        <i class="bi bi-trash"></i> حذف
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-muted">لا توجد أقسام مطابقة للبحث.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- التنقل بين الصفحات -->
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

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>
