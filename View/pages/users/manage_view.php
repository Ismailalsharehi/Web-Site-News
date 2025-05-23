<?php

require_once __DIR__ . '../../../../vendor/autoload.php';

use Core\Flash;
use Core\Database\Connection;
use Controllers\users;
use Core\Session;

Session::start();



$user = Session::get('user_data');

$error = Flash::get('error');
$success = Flash::get('success');
if ($error) {
  echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
} else {
  echo '<div class="alert alert-danger">' . htmlspecialchars($success) . '</div>';
}
// require('../../../Controllers/users/manage.php');
?>


<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>


<div class="bg-light">

  <div class="container mt-5">

    <!-- العنوان وزر الإضافة وعدد المستخدمين -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4>إدارة المستخدمين</h4>

      <a href="create.php" class="btn btn-primary" data-bs-target="#addUserModal">+ <i class="bi bi-person-plus"></i> إضافة مستخدم</a>

    </div>

    <!-- الإحصائيات -->
    <div class="alert alert-info">
      إجمالي المستخدمين: <strong><?= htmlspecialchars($user_count) ?></strong>


    </div>

    <!-- البحث والفلترة -->

    <form method="get" class="row g-3 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو البريد..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
      </div>
      <div class="col-md-3">
        <select class="form-select" name="role">
          <option value="">جميع المستخدمين</option>
          <option value="admin" <?= isset($_GET['role']) && $_GET['role'] === 'admin' ? 'selected' : '' ?>>مدير</option>
          <option value="author" <?= isset($_GET['role']) && $_GET['role'] === 'author' ? 'selected' : '' ?>>كاتب</option>
          <option value="user" <?= isset($_GET['role']) && $_GET['role'] === 'user' ? 'selected' : '' ?>>مستخدم عادي</option>
        </select>
      </div>

      <div class="col-md-3">
        <select class="form-select">
          <option selected>كل الحالات</option>
          <option>نشط</option>
          <option>محظور</option>
          <option>غير مفعل</option>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-secondary w-100">بحث</button>
      </div>
    </form>



    <!-- جدول المستخدمين -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle text-center bg-white">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>البريد</th>
            <th>الدور</th>
            <th>الحالة</th>
            <th>عدد المقالات</th>
            <th>تاريخ التسجيل</th>
            <th>آخر دخول</th>
            <th>الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($filteredUsers as $index => $user): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td> <?= htmlspecialchars($user['full_name']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><?= htmlspecialchars($user['role']) ?></td>
              <td><span class="badge bg-success">نشط</span></td>
              <td>12</td>
              <td><?= htmlspecialchars($user['created_at']) ?></td>
              <td><?= htmlspecialchars($user['updated_at']) ?></td>
              <td>
                <div class="d-flex justify-content-center gap-2 flex-wrap">

                  <!-- فورم التعديل -->
                  <div>
                    <form action="edit.php" method="GET">
                      <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                      <button type="submit" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> تعديل
                      </button>
                    </form>
                  </div>

                  <!-- فورم الحذف -->
                  <div>
                    <form action="delete.php" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                      <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> حذف
                      </button>
                    </form>
                  </div>
                  <!-- فورم عرض التفاصيل -->
                  <div>
                    <form action="show.php" method="GET">
                      <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                      <button type="submit" class="btn btn-sm btn-info" name="show">
                        <i class="bi bi-eye"></i> عرض
                      </button>
                    </form>

                  </div>
              </td>
            </tr>


          <?php endforeach; ?>
          <!-- صفوف   أخرى -->
        </tbody>
      </table>
    </div>


    <!-- رسالة عدم وجود نتائج -->
    <div class="alert alert-warning text-center" style="display:none;">
      لا توجد نتائج مطابقة للبحث.
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



  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
</div>





<?php require_once __DIR__ . '../../../parts/footer.php'; ?>
