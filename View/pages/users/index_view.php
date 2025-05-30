<?php



// require_once __DIR__ . '../../../../vendor/autoload.php';
// use Core\Flash;
// use Core\Session;
// use Controllers\users;


// var_dump($_POST);
// $success = Flash::get('success');
// if ($success) {
//     echo "<div class='alert alert-success'>" . $success . "</div>";
// } 
// $error = Flash::get('error');
// if ($error) {
//     echo "<div class='alert alert-success'>" . $error . "</div>";
// }

// if(!Session::has("csrf_token")){
//     $token = bin2hex(random_bytes(32));
//     Session::set("csrf_token", $token);
//   }
//   $token = Session::get("csrf_token");

?>


<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>



<div class="bg-info">
    <div class="container py-5">
        <div class="card shadow-sm">
            <h2 class="text-primary text-center mt-3">تسجيل الدخول</h2>
            <p class="text-danger text-center">

            </p>
            <div id="loginMessage" class="container mt-3"></div>

            <form action="/users_index" method="POST" class="text-center" enctype="multipart/form-data" id="login">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
            <div class="mb-3">
                    <label for="" class="form-label">الايميل</label>
                    <input type="email" name="email" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">كلمة السر</label>
                    <input type="password" name="password" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" name="submit" value="ارسال" class="btn btn-danger w-50">
                </div>
                <div class="mb-3 form-check"> 
                  <input type="checkbox" name="rememperme" id="" placeholder=" تذكرني ">
                  <label for="" class="form-check-label"> تذكرني</label>
                </div>
                    <p>اذا لم يكن لديك حساب <a href="/users_create">انشاء حساب</a></p>
            </form>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '../../../parts/footer.php'; ?>