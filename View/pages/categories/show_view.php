
<?php 



  
  var_dump($categories);
?>

<?php require_once __DIR__ . '../../../parts/header.php'; ?>

<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>


<section class="bg-light">

<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4>معلومات قسم :<?= htmlspecialchars($categories['name']) ?> </h4> 
    </div>
    <div class="card-body">
    <?php  ?>
      <p><strong>رقم القسم:</strong><?= htmlspecialchars($categories['id']) ?></p>
      <p><strong>الاسم:</strong> <?= htmlspecialchars($categories['name']) ?>  </p>
      <p><strong>الـSlug:</strong>  <?= htmlspecialchars($categories['slug']) ?></p>
      <p><strong>الوصف:</strong>  <?= htmlspecialchars($categories['description']?? 'no description yet') ?></p>
      <p><strong>تاريخ الإنشاء:</strong> <?= htmlspecialchars($categories['created_at']) ?></p>
      <p><strong>آخر تعديل:</strong> <?= htmlspecialchars($categories['updated_at']) ?></p>
      <p><strong>عدد المقالات بهذا القسم: </strong>  <?= htmlspecialchars($article_count)?></p>
      
      <p><strong>عدد المشاهدات لهذا القسم:</strong> <?= htmlspecialchars($categories['id']) ?></p>
    
        
    </div>
    <div class="card-footer text-end">
      <a href="/categories_manage" class="btn btn-secondary">الرجوع</a>
      
    </div>
  </div>
</div>

</section>



<?php require_once __DIR__ . '../../../parts/footer.php'; ?>