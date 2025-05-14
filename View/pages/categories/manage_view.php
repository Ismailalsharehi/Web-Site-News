<?php require('../../parts/header.php') ?>
<?php require('../../parts/navegation.php') ?>
<?php require('../../parts/adminBar.php') ?>




<div class="container my-5">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">قائمة الأقسام</h2>
    <a href="create.php" class="btn btn-success">➕ إضافة قسم جديد</a>
  </div>

  <table class="table table-bordered table-hover text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الاسم في الرابط (Slug)</th>
        <th>تاريخ الإنشاء</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      <!-- مثال ثابت، لاحقًا تُعرض هذه البيانات من قاعدة البيانات -->
      <tr>
        <td>1</td>
        <td>أخبار عاجلة</td>
        <td>urgent</td>
        <td>2025-05-01</td>
        <td>
          <a href="view.php?id=1" class="btn btn-sm btn-info text-white">عرض</a>
          <a href="edit.php?id=1" class="btn btn-sm btn-primary">تعديل</a>
          <a href="delete.php?id=1" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا القسم؟');">حذف</a>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>اقتصاد</td>
        <td>economy</td>
        <td>2025-05-03</td>
        <td>
          <a href="view.php?id=2" class="btn btn-sm btn-info text-white">عرض</a>
          <a href="edit.php?id=2" class="btn btn-sm btn-primary">تعديل</a>
          <a href="delete.php?id=2" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا القسم؟');">حذف</a>
        </td>
      </tr>
      <!-- ... المزيد من الأقسام -->
    </tbody>
  </table>

</div>


<?php require('../../parts/footer.php') ?>