

<?php
use core\Middleware\Middleware;
// use core\Middleware\Middleware;
// use core\Middleware\Middleware;
// use Core\Routers;

require './Core/Routers.php';

$route = new Routers();
$route->get('/users_delete', './delete.php');

$route->post('/users_update', 'controller/users/create.php')->only('admin');


