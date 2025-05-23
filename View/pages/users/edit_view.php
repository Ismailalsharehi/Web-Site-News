<?php
use Core\Session;
use Core\Flash;
use Controller\users;

$error = Flash::get('error');
// $success = new Flash();
$success = Flash::get('success');

if ($error) {
  echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
elseif ($success) {
    echo '<div class="alert alert-success">' . htmlspecialchars($error) . '</div>';
  }


?>


<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>





<!-- // require_once __DIR__ . '../../../../Model/users.php';

// use Model\Users;
// use Core\Database;
// use PDO ; -->

  <div class="card shadow">
    <div class="card-header">
      تعديل بيانات المستخدم
    </div>
    <div class="card-body p-4">
      <form action="update.php" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        <div class="mb-3">
          <label for="full_name" class="form-label">الاسم الكامل</label>
          <input type="text" class="form-control" id="full_name" name="full_name" placeholder="أدخل اسمك الكامل" value="<?= htmlspecialchars($user['full_name']) ?>" required>
          <div class="invalid-feedback">يرجى إدخال الاسم الكامل.</div>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">اسم المستخدم</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="مثال: user123" required minlength="3" maxlength="50" value="<?= htmlspecialchars($user['username']) ?>">
          <div class="invalid-feedback">يرجى إدخال اسم مستخدم صالح (3-50 حرف).</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">البريد الإلكتروني</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required value="<?= htmlspecialchars($user['email']) ?>">
          <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح.</div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">كلمة المرور</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="********"  minlength="6">
          <div class="invalid-feedback">كلمة المرور يجب أن تكون 6 أحرف على الأقل.</div>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">تأكيد كلمة المرور</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="********"  minlength="6">
          <div class="invalid-feedback">يرجى تأكيد كلمة المرور.</div>

        <div class="mb-3">
          <label for="role" class="form-label">الدور</label>
          <select class="form-select" id="role" name="role" required>
            <option value="author" <?= ($user['role']?? '') === 'author' ? 'selected' : '' ?> >كاتب</option>
            <option value="editor" <?= ($user['role']?? '') === 'editor' ? 'selected' : '' ?>>محرر</option>
            <option value="admin" <?= ($user['role']?? '') === 'admin' ? 'selected' : '' ?>>مسؤول</option>
          </select>
          <div class="invalid-feedback">يرجى اختيار دور.</div>
        </div>

        <button type="submit" class="btn btn-primary w-100" name="update_user">تحديث البيانات </button>
      </form>
    </div>
  </div>



<?php require_once __DIR__ . '../../../parts/footer.php'; ?>



