<?php


require_once __DIR__ . '../../../../vendor/autoload.php';
use Core\Flash;

$error = Flash::get('error');
if ($error) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
?>

<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>


<!-- // require_once __DIR__ . '../../../../Model/users.php';

// use Model\Users;
// use Core\Database;
// use PDO ; -->

  <div class="card shadow">
    <div class="card-header">
      إنشاء حساب جديد
    </div>
    <div class="card-body p-4">
      <form action="../../../Controllers/users/create.php" method="POST" novalidate>
        
        <div class="mb-3">
          <label for="full_name" class="form-label">الاسم الكامل</label>
          <input type="text" class="form-control" id="full_name" name="full_name" placeholder="أدخل اسمك الكامل" required>
          <div class="invalid-feedback">يرجى إدخال الاسم الكامل.</div>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">اسم المستخدم</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="مثال: user123" required minlength="3" maxlength="50">
          <div class="invalid-feedback">يرجى إدخال اسم مستخدم صالح (3-50 حرف).</div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">البريد الإلكتروني</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
          <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح.</div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">كلمة المرور</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="********" required minlength="6">
          <div class="invalid-feedback">كلمة المرور يجب أن تكون 6 أحرف على الأقل.</div>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">تأكيد كلمة المرور</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="********" required minlength="6">
          <div class="invalid-feedback">يرجى تأكيد كلمة المرور.</div>

        <div class="mb-3">
          <label for="role" class="form-label">الدور</label>
          <select class="form-select" id="role" name="role" required>
            <option value="author" selected>كاتب</option>
            <option value="editor">محرر</option>
            <option value="admin">مسؤول</option>
          </select>
          <div class="invalid-feedback">يرجى اختيار دور.</div>
        </div>

        <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
      </form>
    </div>
  </div>



<?php require('../../parts/footer.php')?>



