<?php

// require_once __DIR__ . '/../../vendor/autoload.php';
use Core\Session;
use Core\Flash;

$error = Flash::get('error');
$success = Flash::get('success');
?>

<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>

<div class="container my-4">
  <?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($error) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif ($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($success) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
</div>

<div class="container my-5">
  <div class="row">
    <!-- محتوى المقال -->
    <div class="col-lg-9 mx-auto">

      <!-- عنوان الخبر -->
      <h1 class="fw-bold mb-3 display-6 text-dark"><?= htmlspecialchars($article['title']) ?></h1>

      <!-- بيانات المقال -->
      <div class="d-flex flex-wrap justify-content-start text-muted small mb-3">
        <span class="me-3"><i class="bi bi-person"></i> <?= htmlspecialchars($article['author_name']) ?></span>
        <span class="me-3"><i class="bi bi-bookmark"></i> <?= htmlspecialchars($article['category_name']) ?></span>
        <span class="me-3"><i class="bi bi-calendar"></i> <?= htmlspecialchars($article['created_at']) ?></span>
        <span class="me-3"><i class="bi bi-eye"></i> <?= htmlspecialchars($article['views_count']) ?> مشاهدة</span>
        <span class="me-3"><i class="bi bi-star-fill text-warning"></i> <?= $article['is_featured'] ? 'مميز' : 'عادي' ?></span>
        <span><i class="bi bi-check-circle-fill text-success"></i> <?= htmlspecialchars($article['status']) ?></span>
      </div>

      <!-- صورة المقال -->
      <?php if (!empty($article['image_path'])): ?>
        <img src="../../views/media/images/<?= htmlspecialchars($article['image_path']) ?>" class="img-fluid rounded mb-4 shadow-sm" alt="صورة المقال" loading="lazy">
      <?php endif; ?>

      <!-- فيديو -->
      <?php if (!empty($article['video_url'])): ?>
        <div class="ratio ratio-16x9 mb-4">
          <iframe src="<?= htmlspecialchars($article['video_url']) ?>" allowfullscreen></iframe>
        </div>
      <?php endif; ?>

      <!-- الملخص -->
      <?php if (!empty($article['summary'])): ?>
        <div class="alert alert-info fs-5 rounded-3 shadow-sm">
          <?= nl2br(htmlspecialchars($article['summary'])) ?>
        </div>
      <?php endif; ?>

      <!-- المحتوى الكامل -->
      <div class="article-content fs-5 lh-lg mt-4">
        <?= nl2br(htmlspecialchars($article['content'])) ?>
      </div>

    </div>
  </div>
</div>

<?php require_once __DIR__ . '../../../parts/footer.php'; ?>
