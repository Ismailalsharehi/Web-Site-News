<?php require('../../../parts/header.php'); ?>
<?php require('../../../parts/navegation.php') ?>
<?php require('../../../parts/adminBar.php') ?>




<div class="bg-light">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-warning text-dark">
        <h4>تعديل التاج</h4>
      </div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">اسم التاج</label>
            <input type="text" class="form-control" id="name" value="كورونا">
          </div>
          <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" value="corona">
          </div>
          <button type="submit" class="btn btn-warning">تحديث</button>
          <a href="manage.html" class="btn btn-secondary">رجوع</a>
        </form>
      </div>
    </div>
  </div>
</div>



<?php require('../../../parts/footer.php') ?>