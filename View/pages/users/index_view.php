<!-- بشكل عاح عرض  الأخبار للمستخدم -->

<?php


require_once __DIR__ . '../../../../vendor/autoload.php';
use Core\Flash;

$success = Flash::get('success');
if ($success) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($success) . '</div>';
}
?>

<?php include '../../parts/header.php'; ?>
<?php include '../../parts/navegation.php'; ?>




<!-- الخبر الرئيسي -->


<!-- الخبر الرئيسي -->

<!-- <div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm h-100">
            <img src="."  class="card-img-top rounded-0" alt="...">
            <div class="card-body bg-secondary text-white">
                <h4 class="card-title">عنوان الخبر العاجل هنا كما في موقع الحدث</h4>
                <p class="card-text">وصف قصير لهذا الخبر المهم جداً الذي يظهر في أعلى الصفحة.</p>
                <a href="news/single.php?id=1" class="btn btn-primary btn-sm">قراءة المزيد</a>
            </div>
        </div>
    </div>
</div>  -->

<!-- الأخبار الأخرى -->

<!-- <div class="row g-3">
    <div class="col-md-12">
        <h5 class="text-primary mb-3 border-bottom pb-2">آخر الأخبار</h5>
        <div class="row g-3">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <img src="assets/images/news<?= $i ?>.jpg" class="card-img-top rounded-0" alt="...">
                    <div class="card-body p-3">
                        <h6 class="card-title">عنوان الخبر <?= $i ?></h6>
                        <p class="card-text small">وصف قصير لخبر <?= $i ?>...</p>
                        <a href="news/single.php?id=<?= $i ?>" class="btn btn-primary btn-sm">قراءة</a>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div> -->

<!-- زر المزيد -->
<!--  
<div class="text-center mt-4">
    <a href="#" class="btn btn-primary">المزيد من الأخبار</a>
</div> -->





<!-- الخبر الرئيسي -->

<!-- <div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <img src="assets/images/main-news.jpg" class="card-img-top rounded-0" alt="...">
            <div class="card-body">
                <h4 class="card-title text-primary">عنوان الخبر العاجل هنا كما في موقع العربية</h4>
                <p class="card-text">وصف قصير لهذا الخبر المهم جداً الذي يظهر في أعلى الصفحة.</p>
                <a href="news/single.php?id=1" class="btn btn-primary btn-sm">قراءة المزيد</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <img src="assets/images/side-news.jpg" class="card-img-top rounded-0" alt="...">
            <div class="card-body">
                <h6 class="card-title">عنوان خبر جانبي</h6>
                <a href="#" class="btn btn-outline-primary btn-sm">المزيد من الأخبار</a>
            </div>
        </div>
    </div>
</div>


<div class="row g-3">
    <div class="col-md-8">
        <h5 class="text-primary mb-3 border-bottom pb-2">آخر الأخبار</h5>
        <div class="row g-3">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <img src="assets/images/news<?= $i ?>.jpg" class="card-img-top rounded-0" alt="...">
                    <div class="card-body p-3">
                        <h6 class="card-title">عنوان الخبر <?= $i ?></h6>
                        <p class="card-text small">وصف قصير لخبر <?= $i ?>...</p>
                        <a href="news/single.php?id=<?= $i ?>" class="btn btn-primary btn-sm">قراءة</a>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3 border-0 shadow-sm">
            <div class="card-header bg-white text-primary fw-bold">
                الأكثر مشاهدة
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    عنوان خبر 1
                    <span class="badge bg-primary rounded-pill">1</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    عنوان خبر 2
                    <span class="badge bg-primary rounded-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    عنوان خبر 3
                    <span class="badge bg-primary rounded-pill">3</span>
                </li>
            </ul>
        </div>

        <div class="card border-0 shadow-sm">
            <img src="assets/images/advertisement.jpg" class="card-img rounded-0" alt="إعلان">
        </div>
    </div>
</div> -->




<!-- الخبر الرئيسي -->

<div class="row g-3 mb-4">
  <div class="col-md-8">
    <div class="card border-0 shadow-sm h-100">
      <img src="assets/images/main-news.jpg" class="card-img-top rounded-0" alt="...">
      <div class="card-body">
        <h4 class="card-title text-primary">عنوان الخبر العاجل هنا</h4>
        <p class="card-text">وصف قصير لهذا الخبر المهم جداً الذي يظهر في أعلى الصفحة.</p>
        <a href="news/single.php?id=1" class="btn btn-primary btn-sm">قراءة المزيد</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card border-0 shadow-sm h-100">
      <img src="assets/images/side-news.jpg" class="card-img-top rounded-0" alt="...">
      <div class="card-body">
        <h6 class="card-title">عنوان خبر جانبي</h6>
        <a href="#" class="btn btn-outline-success btn-sm">المزيد من الأخبار</a>
      </div>
    </div>
  </div>
</div>


<div class="row g-3">
  <div class="col-md-8">
    <h5 class="text-success mb-3 border-bottom pb-2">آخر الأخبار</h5>
    <div class="row g-3">
      <?php for ($i = 1; $i <= 6; $i++): ?>
        <div class="col-md-6">
          <div class="card border-0 shadow-sm">
            <img src="assets/images/news<?= $i ?>.jpg" class="card-img-top rounded-0" alt="...">
            <div class="card-body p-3">
              <h6 class="card-title">عنوان الخبر <?= $i ?></h6>
              <p class="card-text small">وصف قصير لخبر <?= $i ?>...</p>
              <a href="news/single.php?id=<?= $i ?>" class="btn btn-primary btn-sm">قراءة</a>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </div>


  <div class="col-md-4">
    <div class="card mb-3 border-0 shadow-sm">
      <div class="card-header bg-white text-success fw-bold">
        الأكثر مشاهدة
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          عنوان خبر 1
          <span class="badge bg-success rounded-pill">1</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          عنوان خبر 2
          <span class="badge bg-success rounded-pill">2</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          عنوان خبر 3
          <span class="badge bg-success rounded-pill">3</span>
        </li>
      </ul>
    </div>

    <div class="card border-0 shadow-sm">
      <img src="assets/images/advertisement.jpg" class="card-img rounded-0" alt="إعلان">
    </div>
  </div>
</div>


<?php include '../../parts/footer.php'; ?>