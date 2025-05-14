
<?php require('../../../parts/header.php'); ?>
<?php require('../../../parts/navegation.php') ?>
<?php require('../../../parts/adminBar.php') ?>



<div class="bg-light">
  <div class="container mt-5">
    <h4 class="mb-4">جميع التاجات</h4>
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>اسم التاج</th>
          <th>Slug</th>
          <th>الخيارات</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>كورونا</td>
          <td>corona</td>
          <td>
            <a href="show.html?id=1" class="btn btn-sm btn-primary">عرض</a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>تكنولوجيا</td>
          <td>technology</td>
          <td>
            <a href="show.html?id=2" class="btn btn-sm btn-primary">عرض</a>
          </td>
        </tr>
        <!-- يمكن تكرار الصفوف حسب عدد التاجات -->
      </tbody>
    </table>
  </div>
</div>


<?php require('../../../parts/footer.php') ?>