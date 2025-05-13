<?php
// app/Views/categories/show.php

// Include the default layout (header, footer, navigation)
// The $data variable is passed from the CategoryController
// $data['title'], $data['description'], $data['category'], $data['articles'], $data['categories'] (for nav)

require APPROOT . '/Views/layouts/default.php';
?>

<div class="container mt-4">
    <?php if (isset($data['category']) && $data['category']) : ?>
        <h1 class="mb-4">قسم: <?php echo htmlspecialchars($data['category']->name); ?></h1>
        
        <?php if (isset($data['category']->description) && !empty($data['category']->description)) : ?>
            <p class="lead"><?php echo nl2br(htmlspecialchars($data['category']->description)); ?></p>
            <hr>
        <?php endif; ?>

        <?php if (isset($data['articles']) && !empty($data['articles'])) : ?>
            <div class="row">
                <?php foreach ($data['articles'] as $article) : ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <?php if (!empty($article->image_path)) : ?>
                                <img src="<?php echo URLROOT . '/' . htmlspecialchars($article->image_path); ?>" class="card-img-top card-img-top-custom" alt="<?php echo htmlspecialchars($article->title); ?>">
                            <?php else : ?>
                                <img src="<?php echo URLROOT; ?>/images/default_article_image.png" class="card-img-top card-img-top-custom" alt="صورة افتراضية">
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($article->slug); ?>"><?php echo htmlspecialchars($article->title); ?></a></h5>
                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars(substr($article->summary ?? $article->content, 0, 100)); ?>...</p>
                                <p class="card-text"><small class="text-muted">نشر في: <?php echo date('Y-m-d', strtotime($article->published_at ?? $article->created_at)); ?></small></p>
                                <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($article->slug); ?>" class="btn btn-primary mt-auto">اقرأ المزيد</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Pagination (to be implemented later) -->
            <!-- 
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">السابق</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">التالي</a></li>
                </ul>
            </nav>
            -->
        <?php else : ?>
            <div class="alert alert-info" role="alert">
                لا توجد مقالات في هذا القسم حالياً.
            </div>
        <?php endif; ?>

    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            لم يتم تحديد القسم بشكل صحيح.
        </div>
    <?php endif; ?>
</div>

<?php 
// The default layout already includes the footer, so no need to require it again.
// If you had specific footer content for this page, you could add it here before the closing php tag.
?>

