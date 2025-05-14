<?php require('../../../parts/header.php'); ?>
<?php require('../../../parts/navegation.php') ?>
<?php require('../../../parts/adminBar.php') ?>


<div class="bg-light">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h4>إضافة تاج جديد</h4>
      </div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">اسم التاج</label>
            <input type="text" class="form-control" id="name" placeholder="مثال: كورونا">
          </div>
          <div class="mb-3">
            <label for="slug" class="form-label">Slug (رابط صديق)</label>
            <input type="text" class="form-control" id="slug" placeholder="مثال: corona">
          </div>
          <button type="submit" class="btn btn-success">حفظ</button>
          <a href="manage.html" class="btn btn-secondary">إلغاء</a>
        </form>
      </div>
    </div>
  </div>
</div>



<?php require('../../../parts/footer.php') ?>