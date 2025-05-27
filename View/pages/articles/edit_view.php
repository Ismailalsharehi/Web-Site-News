<?php
// require_once __DIR__ . '../../../../vendor/autoload.php';

use Core\Session;
  use Core\Flash;
use Controllers\articles;

// $success = new Flash();
$error = Flash::get('error');
$success = Flash::get('success');
// var_dump($article);

if ($error) {
  echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
elseif ($success) {
    echo '<div class="alert alert-success">' . htmlspecialchars($error) . '</div>';
  }


  
  // var_dump($categories['slug']);
?>


<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>
<div class="container mt-5">
  <h2>تعديل المقال</h2>

  

  <form action="/article_update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $article['id'] ?>">
    <input type="hidden" name="_method" value="PUT">
    
    <div class="row">
      <div class="col-md-8">
        <div class="mb-3">
          <label for="title" class="form-label">عنوان المقال</label>
          <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
        </div>

        <div class="mb-3">
          <label for="summary" class="form-label">ملخص المقال</label>
          <textarea class="form-control" id="summary" name="summary" rows="3"><?= htmlspecialchars($article['summary']) ?></textarea>
        </div>

        <div class="mb-3"> 
          <label for="content" class="form-label">محتوى المقال</label>
          <textarea class="form-control" id="content" name="content" rows="10"><?= htmlspecialchars($article['content']) ?></textarea>
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
                <?php foreach ($categories as $cat): ?>
                  <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $article['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="tags" class="form-label">الوسوم (اختياري)</label>
              <input type="text" class="form-control" id="tags" name="slug" value="<?= htmlspecialchars($article['slug']) ?>">
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">صورة المقال</label>
              <input type="file" class="form-control" id="image" name="photo" accept="image/*">
              <?php if (!empty($article['photo'])): ?>
                <img src="images/<?= $article['image_path'] ?>" class="img-thumbnail mt-2" width="150">
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="video_url" class="form-label">رابط الفيديو</label>
              <input type="url" class="form-control" id="video_url" name="video_url" value="<?= htmlspecialchars($article['video_url']) ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">الحالة</label>
              <select class="form-select" id="status" name="status" required>
                <option value="draft" <?= $article['status'] == 'draft' ? 'selected' : '' ?>>مسودة</option>
                <option value="published" <?= $article['status'] == 'published' ? 'selected' : '' ?>>منشور</option>
                <option value="archived" <?= $article['status'] == 'archived' ? 'selected' : '' ?>>مؤرشف</option>
              </select>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" <?= $article['is_featured'] ? 'checked' : '' ?>>
              <label class="form-check-label" for="is_featured">مقال مميز</label>
            </div>

            <input type="hidden" name="user_id" value="<?= Session::get('user_id', 1) ?>">
            
          </div>
        </div>
      </div>
    </div>
    <button type="submit" name="update_article" class="btn btn-success">تحديث المقال</button>
          
  </form>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>
