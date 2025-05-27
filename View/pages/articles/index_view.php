<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>

<style>
  /* شريط الأخبار العاجلة */
  .breaking-news-container {
    background: #d32f2f;
    color: white;
    overflow: hidden;
    white-space: nowrap;
    position: relative;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .breaking-news-content {
    display: inline-block;
    padding-left: 100%;
    animation: scroll-left 25s linear infinite;
  }

  @keyframes scroll-left {
    0% {
      transform: translateX(0%);
    }

    100% {
      transform: translateX(-100%);
    }
  }

  /* الصور في البطاقات */
  .card-img-top {
    height: 220px;
    object-fit: cover;
    border-radius: 0.375rem;
  }

  /* عناوين الأخبار */
  .news-title {
    font-weight: 700;
    font-size: 1.1rem;
    color: #212529;
    transition: color 0.3s;
  }

  .news-title:hover {
    color: #0d6efd;
    text-decoration: underline;
  }

  /* الشريط الجانبي */
  .sidebar-section {
    background: #fff;
    border-radius: 0.375rem;
    box-shadow: 0 0 10px rgb(0 0 0 / 0.1);
    margin-bottom: 1.5rem;
    padding: 1rem;
  }

  .sidebar-section h5 {
    font-weight: 700;
    border-bottom: 3px solid #0d6efd;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
  }

  /* أزرار المشاركة */
  .share-btns a {
    margin-right: 5px;
    font-size: 1.1rem;
    color: #555;
    transition: color 0.3s;
  }

  .share-btns a:hover {
    color: #0d6efd;
  }
</style>

<!-- شريط الأخبار العاجلة -->
<div class="breaking-news-container py-2 px-3 mb-4">
  <div class="breaking-news-content">
    <?php foreach ($newsNow as $news): ?>
      🔴 <a href="/article_show_view?slug=<?= htmlspecialchars($news['slug']) ?>" class="text-white fw-bold text-decoration-none me-4">
        <?= htmlspecialchars($news['title']) ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- نموذج البحث -->
<form method="GET" action="" class="row g-3 align-items-end mb-4 px-2 px-md-0">
  <div class="col-md-4">
    <label for="q" class="form-label fw-semibold">كلمة مفتاحية</label>
    <input type="text" class="form-control" id="q" name="q" placeholder="ابحث عن مقال..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  </div>
  <div class="col-md-3">
    <label for="category_id" class="form-label fw-semibold">القسم</label>
    <select name="category_id" id="category_id" class="form-select">
      <option value="">كل الأقسام</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>" <?= ($_GET['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-3">
    <label for="author_id" class="form-label fw-semibold">الكاتب</label>
    <select name="author_id" id="author_id" class="form-select">
      <option value="">كل الكُتّاب</option>
      <?php foreach ($authors as $auth): ?>
        <option value="<?= $auth['id'] ?>" <?= ($_GET['author_id'] ?? '') == $auth['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($auth['full_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-2 d-grid">
    <button type="submit" class="btn btn-primary fw-bold">🔍 بحث</button>
  </div>
</form>

<!-- محتوى الصفحة الرئيسية -->
<div class="row gx-4 gy-4">
  <!-- القسم الرئيسي: آخر الأخبار -->
  <div class="col-lg-8">
    <h4 class="mb-3 text-primary border-start border-4 border-primary ps-3 fw-bold">آخر الأخبار</h4>
    <div class="row gy-4">
      <?php foreach ($articles as $article): ?>
        <div class="col-md-6">
          <div class="card shadow-sm border-0 h-100">
            <a href="/article_show?slug=<?= urlencode($article['slug']) ?>"><img src="../../views/media/images/<?= htmlspecialchars($article['image_path']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="card-img-top" loading="lazy"></a>
            <div class="card-body d-flex flex-column">
              <h6 class="news-title"><?= htmlspecialchars($article['title']) ?></h6>
              <p class="card-text text-muted flex-grow-1"><?= htmlspecialchars($article['summary']) ?></p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="/article_show?slug=<?= urlencode($article['slug']) ?>" class="btn btn-sm btn-primary fw-bold">اقرأ المزيد</a>
                <div class="share-btns">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://localhost/Ismail/website-news/articles/' . $article['slug']); ?>"
                    target="_blank"
                    title="شارك على فيسبوك"
                    rel="noopener noreferrer">
                    <i class="bi bi-facebook"></i>
                  </a>
                  <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://localhost/Ismail/website-news/articles/' . $article['slug']); ?>"
                    target="_blank"
                    title="شارك على تويتر"
                    rel="noopener noreferrer">
                    <i class="bi bi-twitter"></i>
                  </a>
                  <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('http://localhost/Ismail/website-news/articles/' . $article['slug']); ?>"
                    target="_blank"
                    title="شارك على واتساب"
                    rel="noopener noreferrer">
                    <i class="bi bi-whatsapp"></i>
                  </a>
                  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode('http://localhost/Ismail/website-news/articles/' . $article['slug']); ?>"
                    target="_blank"
                    title="شارك على لينكد إن"
                    rel="noopener noreferrer">
                    <i class="bi bi-linkedin"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- الشريط الجانبي -->
  <aside class="col-lg-4">
    <!-- الأكثر مشاهدة -->
    <section class="sidebar-section">
      <h5>الأكثر مشاهدة</h5>
      <ul class="list-group list-group-flush">
        <?php foreach ($Viewed as $views): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
            <a href="/article_show?slug=<?= htmlspecialchars($views['slug']) ?>" class="text-decoration-none">
              <?= htmlspecialchars($views['title']) ?>
            </a>
            <span class="badge bg-primary rounded-pill"><?= $views['views_count'] ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <!-- التصنيفات -->
    <section class="sidebar-section">
      <h5>التصنيفات</h5>
      <ul class="list-group list-group-flush">
        <li class="list-group-item px-0 py-2 border-0"><a href="category.php?cat=politics" class="text-decoration-none">سياسة</a></li>
        <li class="list-group-item px-0 py-2 border-0"><a href="category.php?cat=sports" class="text-decoration-none">رياضة</a></li>
        <li class="list-group-item px-0 py-2 border-0"><a href="category.php?cat=tech" class="text-decoration-none">تقنية</a></li>
        <li class="list-group-item px-0 py-2 border-0"><a href="archive.php" class="text-decoration-none">أرشيف الأخبار</a></li>
      </ul>
    </section>

    <!-- إعلان جانبي -->
    <section class="sidebar-section text-center">
      <img src="assets/images/ad.jpg" alt="إعلان" class="img-fluid rounded" loading="lazy">
    </section>
  </aside>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>