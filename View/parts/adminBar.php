


<!-- هنا كل الازرار الخاصة بالمدير حق التعدل والحذف والاضافة ووو كل زر طبعاً داخل فووورم معين

 
<?php if ($_SESSION['user'] ?? false) : ?>

  <?php if ($_SESSION['user']['type'] == "admin" || $_SESSION['user']['type'] == "manager") : ?>
        <nav class="bar_admin">
          

         <li>
            <form action="/islamic_endowments_manage" method="get"><input type="hidden" name="" value=""><button type="submit" aria-label="الاوقاف">الاوقاف</button></form>
       </li> -->