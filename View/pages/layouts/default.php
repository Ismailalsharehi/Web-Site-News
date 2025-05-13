<?php
// app/Views/layouts/default.php

// هذا ملف التخطيط الافتراضي الذي سيتم استخدامه لمعظم صفحات الموقع
// يحتوي على الهيدر والفوتر والمكان الذي سيتم فيه عرض محتوى الصفحة المحدد
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($data["description"]) ? htmlspecialchars($data["description"]) : SITENAME; ?>">
    <title><?php echo isset($data["title"]) ? htmlspecialchars($data["title"]) : SITENAME; ?></title>
    <!-- Bootstrap CSS (مثال، يمكنك استخدام أي إطار عمل CSS أو CSS مخصص) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css"> 
    <style>
        body {
            font-family: 'Tahoma', sans-serif; /* خط عربي مناسب */
            background-color: #f4f4f4;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .article-summary {
            margin-bottom: 15px;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }
        .featured-articles, .latest-articles {
            margin-bottom: 30px;
        }
        .card-img-top-custom {
            width: 100%;
            height: 200px; /* ارتفاع ثابت للصور */
            object-fit: cover; /* لضمان تناسب الصورة دون تشويه */
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo URLROOT; ?>">الرئيسية</a>
                        </li>
                        <?php if (isset($data["categories"]) && !empty($data["categories"])) : ?>
                            <?php foreach ($data["categories"] as $category) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo URLROOT; ?>/category/<?php echo htmlspecialchars($category->slug); ?>"><?php echo htmlspecialchars($category->name); ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/contact">اتصل بنا</a>
                        </li>
                        <!-- يمكنك إضافة روابط تسجيل الدخول/الخروج هنا -->
                    </ul>
                    <form class="d-flex" action="<?php echo URLROOT; ?>/search" method="get">
                        <input class="form-control me-2" type="search" name="query" placeholder="بحث..." aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">بحث</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <?php 
        // هذا هو المكان الذي سيتم فيه تحميل محتوى العرض المحدد
        // على سبيل المثال، إذا كان العرض هو home/index, فسيتم تحميل app/Views/home/index.php هنا
        // ولكن الطريقة المتبعة حالياً هي أن ملف العرض (مثل home/index.php) سيقوم بتضمين هذا التخطيط.
        // لذا، سنترك هذا فارغاً، وسيقوم ملف العرض الفعلي بتضمين هذا الملف ثم عرض محتواه الخاص.
        // أو يمكن تعديل Controller::view() ليدعم نظام قوالب أكثر تقدماً.
        // للتبسيط الآن، ملفات العرض مثل home/index.php ستقوم بتضمين هذا الملف.
        ?>
    </main>

    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container">
            <span class="text-muted">&copy; <?php echo date("Y"); ?> <?php echo SITENAME; ?>. جميع الحقوق محفوظة.</span>
        </div>
    </footer>

    <!-- Bootstrap JS (مثال) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>
</body>
</html>

