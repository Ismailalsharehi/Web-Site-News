<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>


<div class="container mt-5">
  <h2>إضافة مقال جديد</h2>

  <form action="process_article.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-8">
        <div class="mb-3">
          <label for="title" class="form-label">عنوان المقال</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
          <label for="summary" class="form-label">ملخص المقال</label>
          <textarea class="form-control" id="summary" name="summary" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label for="content" class="form-label">محتوى المقال</label>
          <textarea class="form-control" id="content" name="content" rows="10"></textarea>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">إعدادات المقال</h5>

            <div class="mb-3">
              <label for="category_id" class="form-label">التصنيف</label>
              <select class="form-select" id="category_id" name="category_id" required>
                <option value="">اختر تصنيفاً</option>
                
                  <option value=" hellow" > </option>
                
              </select>
            </div>

            <div class="mb-3">
              <label for="tags" class="form-label">الوسوم (اختياري)</label>
              <input type="text" class="form-control" id="tags" name="tags" placeholder="مثال: تقنية،أخبار،2024">
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">صورة المقال الرئيسية</label>
              <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
              <label for="video_url" class="form-label">رابط فيديو (اختياري)</label>
              <input type="url" class="form-control" id="video_url" name="video_url" placeholder="https://youtube.com/...">
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">الحالة</label>
              <select class="form-select" id="status" name="status" required>
                <option value="draft">مسودة</option>
                <option value="published">منشور</option>
                <option value="archived">مؤرشف</option>
              </select>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured">
              <label class="form-check-label" for="is_featured">مقال مميز</label>
            </div>

            <!-- تمرير معرف المستخدم الحالي -->
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 1 ?>"> <!-- فرضًا لديك جلسة مستخدم -->

            <div class="d-grid gap-2">
              <button type="submit" name="add_article" class="btn btn-primary">نشر المقال</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>



<?php require('../../parts/footer.php') ?>