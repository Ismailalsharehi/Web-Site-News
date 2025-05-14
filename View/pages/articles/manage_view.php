<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>

<section class="bg-light">

  <div class="container mt-4">
    <h1 class="mb-4">📄 إدارة المقالات</h1>

    <a href="create_article.php" class="btn btn-success mb-3">➕ إضافة مقال جديد</a>

    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>الصورة</th>
          <th>العنوان</th>
          <th>التصنيف</th>
          <th>الكاتب</th>
          <th>الحالة</th>
          <th>مميز؟</th>
          <th>عدد المشاهدات</th>
          <th>تاريخ النشر</th>
          <th>التحكم</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $article): ?>
          <tr>
            <td><?= $article['id'] ?></td>

            <td>
              <?php if (!empty($article['image_path'])): ?>
                <img src="<?= htmlspecialchars($article['image_path']) ?>" width="60" class="img-thumbnail">
              <?php else: ?>
                <span class="text-muted">لا توجد صورة</span>
              <?php endif; ?>
            </td>

            <td><?= htmlspecialchars($article['title']) ?></td>
            <td><?= htmlspecialchars($article['category_name']) ?></td>
            <td><?= htmlspecialchars($article['author_name']) ?></td>

            <td>
              <span class="badge bg-<?=
                                    $article['status'] === 'published' ? 'success' : ($article['status'] === 'draft' ? 'secondary' : 'danger') ?>">
                <?= $article['status'] ?>
              </span>
            </td>

            <td>
              <?= $article['is_featured'] ? '<span class="badge bg-warning text-dark">✔</span>' : '—' ?>
            </td>

            <td><?= $article['views_count'] ?></td>
            <td>
              <?= $article['published_at'] ? date('Y-m-d', strtotime($article['published_at'])) : '—' ?>
            </td>

            <td>
              <a href="view_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-primary">👁 عرض</a>
              <a href="edit_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-warning">✏ تعديل</a>
              <a href="delete_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">🗑 حذف</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</section>

<?php require('../../parts/footer.php') ?>