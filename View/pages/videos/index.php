<?php
// app/Views/videos/index.php

// Include the default layout (header, footer, navigation)
// The $data variable is passed from the VideoController
// $data["title"], $data["description"], $data["videos"], $data["categories"] (for nav)

require APPROOT . 
'/Views/layouts/default.php


?>

<div class="container mt-4">
    <h1 class="mb-4"><?php echo htmlspecialchars($data["title"]); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($data["description"]); ?></p>
    <hr>

    <?php if (isset($data["videos"]) && !empty($data["videos"])) : ?>
        <div class="row">
            <?php foreach ($data["videos"] as $video_article) : ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($video_article->image_path)) : ?>
                            <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($video_article->slug); ?>">
                                <img src="<?php echo URLROOT . '/' . htmlspecialchars($video_article->image_path); ?>" class="card-img-top card-img-top-custom" alt="<?php echo htmlspecialchars($video_article->title); ?>">
                            </a>
                        <?php elseif ($video_article->video_url && strpos($video_article->video_url, 'youtube.com') !== false) : 
                            // Extract YouTube video ID and generate thumbnail URL
                            // Example URL: https://www.youtube.com/watch?v=VIDEO_ID
                            // Thumbnail URL: https://img.youtube.com/vi/VIDEO_ID/0.jpg (or hqdefault.jpg for higher quality)
                            parse_str(parse_url($video_article->video_url, PHP_URL_QUERY), $queryParams);
                            $youtubeVideoId = $queryParams['v'] ?? null;
                            if ($youtubeVideoId) : ?>
                                <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($video_article->slug); ?>">
                                    <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($youtubeVideoId); ?>/hqdefault.jpg" class="card-img-top card-img-top-custom" alt="<?php echo htmlspecialchars($video_article->title); ?>">
                                </a>
                            <?php else: ?>
                                <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($video_article->slug); ?>">
                                    <img src="<?php echo URLROOT; ?>/images/default_video_thumb.png" class="card-img-top card-img-top-custom" alt="فيديو">
                                </a>
                            <?php endif; ?>
                        <?php else : ?>
                             <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($video_article->slug); ?>">
                                <img src="<?php echo URLROOT; ?>/images/default_video_thumb.png" class="card-img-top card-img-top-custom" alt="فيديو">
                            </a>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($video_article->slug); ?>"><?php echo htmlspecialchars($video_article->title); ?></a></h5>
                            <p class="card-text flex-grow-1"><?php echo htmlspecialchars(substr($video_article->summary ?? '', 0, 100)); ?>...</p>
                            <p class="card-text"><small class="text-muted">نشر في: <?php echo date('Y-m-d', strtotime($video_article->published_at ?? $video_article->created_at)); ?></small></p>
                            <a href="<?php echo URLROOT; ?>/article/show/<?php echo htmlspecialchars($video_article->slug); ?>" class="btn btn-primary mt-auto">شاهد الفيديو</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Pagination (to be implemented later) -->
    <?php else : ?>
        <div class="alert alert-info" role="alert">
            لا توجد فيديوهات متاحة حالياً.
        </div>
    <?php endif; ?>
</div>

<?php 
// The default layout includes the footer.
?>

