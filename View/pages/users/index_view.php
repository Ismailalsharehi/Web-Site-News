<!-- تأكد من تحميل Bootstrap RTL -->

<?php include '../../parts/header.php'; ?>
<?php include '../../parts/navegation.php'; ?>

<section class="py-5" style="background-color: #e9ecef; font-family: 'Tajawal', sans-serif;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4">
            <h2 class="text-center text-primary mb-4">تسجيل الدخول</h2>

            <form action="" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">تذكرني</label>
              </div>

              <button type="submit" class="btn btn-primary w-100">دخول</button>

              <div class="text-center mt-3">
                <a href="#" class="text-secondary">نسيت كلمة المرور؟</a>
                <span class="mx-2">|</span>
                <a href="signup.php" class="text-secondary">إنشاء حساب جديد</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
