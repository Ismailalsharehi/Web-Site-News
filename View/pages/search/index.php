<?php
// app/Views/search/index.php

// Include the default layout (header, footer, navigation)
// The $data variable is passed from the SearchController
// $data["title"], $data["description"], $data["searchTerm"], $data["articles"], $data["categories"] (for nav)

require APPROOT . 
'/Views/layouts/default.php


?>

<div class="container mt-4">
    <h1 class="mb-3">نتائج البحث عن: "<?php echo htmlspecialchars($data["searchTerm"]); ?>"</h1>

    <?php if (isset($data["articles"]) && !empty($data["articles"])) : ?>
        <p class="lead">تم العثور على <?php echo count($data["articles"]); ?> نتيجة.</p>
        <hr>
        <div class="row">
            <?php foreach ($data["articles"] as $article) : ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($article->image_path)) : ?>
                            <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($article->slug); ?>">
                                <img src="<?php echo URLROOT . '/' . htmlspecialchars($article->image_path); ?>" class="card-img-top card-img-top-custom" alt="<?php echo htmlspecialchars($article->title); ?>">
                            </a>
                        <?php else : ?>
                             <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($article->slug); ?>">
                                <img src="<?php echo URLROOT; ?>/images/default_article_image.png" class="card-img-top card-img-top-custom" alt="صورة افتراضية">
                            </a>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($article->slug); ?>"><?php echo htmlspecialchars($article->title); ?></a></h5>
                            <p class="card-text flex-grow-1"><?php echo htmlspecialchars(substr($article->summary ?? strip_tags($article->content), 0, 100)); ?>...</p>
                            <p class="card-text"><small class="text-muted">نشر في: <?php echo date('Y-m-d', strtotime($article->published_at ?? $article->created_at)); ?></small></p>
                            <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($article->slug); ?>" class="btn btn-primary mt-auto">اقرأ المزيد</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (!empty($data["searchTerm"])) : ?>
        <div class="alert alert-info" role="alert">
            لم يتم العثور على نتائج للبحث عن "<?php echo htmlspecialchars($data["searchTerm"]); ?>".
        </div>
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            الرجاء إدخال كلمة للبحث.
        </div>
    <?php endif; ?>
</div>

<?php 
// The default layout includes the footer.
?>

