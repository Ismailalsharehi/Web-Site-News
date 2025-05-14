<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>



<div class="container my-5">
  <div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
      <h5 class="mb-0">تعديل القسم</h5>
    </div>
    <div class="card-body">
      <form action="#" method="post">
        <!-- حقل مخفي لرقم القسم (id) -->
        <input type="hidden" name="id" value="3">

        <!-- اسم القسم -->
        <div class="mb-3">
          <label for="name" class="form-label">اسم القسم</label>
          <input type="text" class="form-control" id="name" name="name" value="اقتصاد" required>
        </div>

        <!-- slug -->
        <div class="mb-3">
          <label for="slug" class="form-label">الاسم في الرابط (slug)</label>
          <input type="text" class="form-control" id="slug" name="slug" value="economy" required>
        </div>

        <!-- الوصف -->
        <div class="mb-3">
          <label for="description" class="form-label">الوصف</label>
          <textarea class="form-control" id="description" name="description" rows="4">قسم يهتم بالأخبار الاقتصادية المحلية والعالمية.</textarea>
        </div>

        <!-- أزرار -->
        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="#" class="btn btn-secondary">إلغاء</a>
      </form>
    </div>
  </div>
</div>


<?php require('../../parts/footer.php') ?>