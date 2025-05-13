
<!-- تأكد من تحميل Bootstrap RTL -->

<?php include '../../parts/header.php'; ?>
<?php include '../../parts/navegation.php'; ?>

<section class="py-5" style="background-color: #e9ecef; font-family: 'Tajawal', sans-serif;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4">
            <h2 class="text-center text-primary mb-4">إنشاء حساب جديد</h2>

            <form action="" method="">
              <div class="mb-3">
                <label for="name" class="form-label">الاسم الكامل</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسمك">
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********">
              </div>

              <div class="mb-3">
                <label for="confirm_password" class="form-label">تأكيد كلمة المرور</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="أعد كتابة كلمة المرور">
              </div>

              <button type="submit" class="btn btn-primary w-100">إنشاء الحساب</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
