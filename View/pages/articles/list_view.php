

<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>

<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>


<div class="row gx-4 gy-4">
  <!-- القسم الرئيسي: آخر الأخبار -->
  <div class="col-lg-8">
    <h4 class="mb-3 text-primary border-start border-4 border-primary ps-3 fw-bold"><?= $category['name'] ?></h4>
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

    <!-- إعلان جانبي -->
    <section class="sidebar-section text-center">
      <img src="assets/images/ad.jpg" alt="إعلان" class="img-fluid rounded" loading="lazy">
    </section>
  </aside>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>