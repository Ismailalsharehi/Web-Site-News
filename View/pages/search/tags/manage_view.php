<?php require('../../../parts/header.php'); ?>
<?php require('../../../parts/navegation.php') ?>
<?php require('../../../parts/adminBar.php') ?>




<div class="bg-light">
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>إدارة التاجات</h4>
      <a href="create.html" class="btn btn-success">إضافة تاج جديد</a>
    </div>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>الاسم</th>
          <th>Slug</th>
          <th>الإجراءات</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>كورونا</td>
          <td>corona</td>
          <td>
            <a href="show.html" class="btn btn-sm btn-primary">عرض</a>
            <a href="edit.html" class="btn btn-sm btn-warning">تعديل</a>
            <button class="btn btn-sm btn-danger">حذف</button>
          </td>
        </tr>
        <!-- المزيد من الصفوف -->
      </tbody>
    </table>
  </div>
</div>


<?php require('../../../parts/footer.php') ?>