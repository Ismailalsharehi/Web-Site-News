 <?php


use Core\Middleware;  
use Core\Routers;

require_once '../parts/header.php';
require_once '../parts/navegation.php';

echo '<div class="bg-light">';
echo '<div class="container mt-5">';  
echo '<div class="alert alert-danger text-center" role="alert">';
echo '<h4 class="alert-heading">404 - الصفحة غير موجودة</h4>';
echo '<p>عذرًا، الصفحة التي تبحث عنها غير موجودة. قد تكون قد تمت إزالتها أو تغيير عنوانها.</p>';

require_once '../parts/footer.php';
?>