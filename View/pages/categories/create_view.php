<?php 


?>


<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>



<div class="container my-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">إنشاء قسم جديد</h5>
    </div>
    <div class="card-body">
      <form action="/categories_store" method="post">
        <!-- اسم القسم -->
        <div class="mb-3">
          <label for="name" class="form-label">اسم القسم</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="مثال: سياسة" required>
        </div>

        <!-- الاسم المخصص للرابط (slug) -->
        <div class="mb-3">
          <label for="slug" class="form-label">الاسم في الرابط (slug)</label>
          <input type="text" class="form-control" id="slug" name="slug" placeholder="مثال: politics" required>
          <div class="form-text">استخدم أحرفًا إنجليزية بدون فراغات، مثل: <code>technology</code></div>
        </div>

        <!-- وصف القسم -->
        <div class="mb-3">
          <label for="description" class="form-label">وصف القسم</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="وصف مختصر للقسم (اختياري)"></textarea>
        </div>

        <!-- زر الإرسال -->
        <button type="submit" class="btn btn-success" name="create">حفظ القسم</button>
        <a href="/categories_manage_view" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>












<?php require('../../parts/footer.php') ?>