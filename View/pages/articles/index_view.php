
<?php 
  use Controllers\articles;
?>
<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>



<!--  شريط الأخبار العاجلة -->
<div class="bg-danger text-white py-2 px-3 mb-3">
  <marquee behavior="scroll" direction="right" scrollamount="5">
    <?php foreach ($newsNow as $news): ?>
  🔴 عاجل: <a href="news/single.php?slug=news-<?= htmlspecialchars($news['slug']) ?>" class="text-white fw-bold">
    <?= htmlspecialchars($news['title']) ?>
  </a> &nbsp;&nbsp;&nbsp;
<?php endforeach; ?>

  </marquee>
</div>


<!--  نموذج البحث -->
<form method="GET" action="" class="row g-3 align-items-end mb-4">

  <!-- حقل البحث -->
  <div class="col-md-4">
    <label for="q" class="form-label">كلمة مفتاحية</label>
    <input type="text" class="form-control" id="q" name="q" placeholder="ابحث عن مقال..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  </div>

  <!-- تحديد القسم -->
  <div class="col-md-3">
    <label for="category_id" class="form-label">القسم</label>
    <select name="category_id" id="category_id" class="form-select">
      <option value="">كل الأقسام</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>" <?= ($_GET['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- تحديد الكاتب -->
  <div class="col-md-3">
    <label for="author_id" class="form-label">الكاتب</label>
    <select name="author_id" id="author_id" class="form-select">
      <option value="">كل الكُتّاب</option>
      <?php foreach ($authors as $auth): ?>
        <option value="<?= $auth['id'] ?>" <?= ($_GET['author_id'] ?? '') == $auth['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($auth['full_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- زر البحث -->
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary w-100">🔍 بحث</button>
  </div>

</form>


<!--  محتوى الصفحة الرئيسي -->
<div class="row g-3">
  <!--  المقالات -->
  <div class="col-md-8">
    <h5 class="text-success mb-3 border-bottom pb-2">آخر الأخبار</h5>
    <div class="row g-3">
      
      <?php foreach ($articles as $article): ?>

        <div class="col-md-6">
          <div class="card border-0 shadow-sm">
            <img src="assets/images/news/<?= htmlspecialchars($article['image_path']) ?>" class="card-img-top rounded-0 img-fluid" loading="lazy" alt="<?= htmlspecialchars($article['title']) ?>">
            <div class="card-body p-3">
              <h6 class="card-title">عنوان الخبر: <?= htmlspecialchars($article['title']) ?></h6>
              <p class="card-text small"><?= htmlspecialchars($article['summary']) ?></p>
              <a href="news/single.php?slug=<?= urlencode($article['slug']) ?>" class="btn btn-primary btn-sm">قراءة</a>
              <div class="mt-2">
                <a href="<?= 'https://' . $_SERVER['HTTP_HOST'] . '/news/single.php?slug=' . urlencode($article['slug']) ?>
" class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener noreferrer">
                  <i class="bi bi-facebook"></i>
                </a>
                <a href="<?= 'https://' . $_SERVER['HTTP_HOST'] . '/news/single.php?slug=' . urlencode($article['slug']) ?>
" class="btn btn-sm btn-outline-info" target="_blank" rel="noopener noreferrer">
                  <i class="bi bi-twitter-x"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!--  الشريط الجانبي -->
  <div class="col-md-4">
    <!-- الأكثر مشاهدة -->
  <div class="card mb-3 border-0 shadow-sm">
  <div class="card-header bg-white text-success fw-bold">الأكثر مشاهدة</div>
  <ul class="list-group list-group-flush">
    <?php foreach ($Viewed as $views): ?>
      <li class="list-group-item d-flex justify-content-between">
        <a href="news/single.php?slug=news-<?= htmlspecialchars($views['slug']) ?>">
          <?= htmlspecialchars($views['title']) ?>
        </a>
        <span class="badge bg-success"><?= $views['views_count'] ?></span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>


    <!-- التصنيفات -->
    <div class="card mb-3 border-0 shadow-sm">
      <div class="card-header bg-white text-primary fw-bold">التصنيفات</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="category.php?cat=politics">سياسة</a></li>
        <li class="list-group-item"><a href="category.php?cat=sports">رياضة</a></li>
        <li class="list-group-item"><a href="category.php?cat=tech">تقنية</a></li>
        <li class="list-group-item"><a href="archive.php">أرشيف الأخبار</a></li>
      </ul>
    </div>

    <!-- إعلان -->
    <div class="card border-0 shadow-sm">
      <img src="assets/images/ad.jpg" class="card-img img-fluid" loading="lazy" alt="إعلان">
    </div>
  </div>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>
