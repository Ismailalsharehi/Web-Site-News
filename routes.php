

<?php

$router->get('/', 'controllers/articles/index.php');


// $router->get('/login', 'Controllers/users/create.php');

//users Access Controllers 


$router->get('/users_create', 'Controllers/users/create.php');
$router->delete('/users_destroy', 'Controllers/users/delete.php'); // only admin
$router->get('/users_edit', 'Controllers/users/edit.php');
$router->post('/users_index', 'Controllers/users/index.php');
$router->get('/users_show', 'Controllers/users/show.php');
$router->get('/users_manage', 'Controllers/users/manage.php'); // only admin
$router->post('/users_store', 'Controllers/users/store.php');
$router->put('/users_update', 'controllers/users/update.php');


// access article controllers
$router->get('/article_index', 'Controllers/articles/index.php');
$router->get('/article_show', 'Controllers/articles/show.php');
$router->get('/article_create', 'Controllers/articles/create.php');
$router->delete('/article_destroy', 'Controllers/articles/delete.php'); // only admin
$router->get('/article_edit', 'Controllers/articles/edit.php');
$router->get('/article_manage', 'Controllers/articles/manage.php'); // only admin
$router->post('/article_store', 'Controllers/articles/store.php');
$router->put('/article_update', 'controllers/articles/update.php');
$router->get('/list', 'Controllers/articles/list.php');


// acces categories controllers
$router->get('/categories_index', 'Controllers/categories/index.php');
$router->get('/categories_show', 'Controllers/categories/show.php');
$router->get('/categories_create', 'Controllers/categories/create.php');
$router->delete('/categories_destroy', 'Controllers/categories/delete.php'); // only admin
$router->get('/categories_edit', 'Controllers/categories/edit.php');
$router->get('/categories_manage', 'Controllers/categories/manage.php'); // only admin
$router->post('/categories_store', 'Controllers/categories/store.php');
$router->put('/categories_update', 'controllers/categories/update.php');



//access users views
$router->get('/users_create_view', 'View/pages/users/create_view.php');
$router->get('/users_edit_view', 'View/pages/users/edit_view.php');
$router->get('/users_index_view', 'View/pages/users/index_view.php');
$router->get('/users_manage_view', 'View/pages/users/manage_view.php');
$router->get('/users_show_view', 'View/pages/users/show_view.php');




// access article views
$router->get('/article_create_view', 'View/pages/articles/create_view.php');
$router->get('/article_edit_view', 'View/pages/articles/edit_view.php');
$router->get('/article_index_view', 'View/pages/articles/index_view.php');
$router->get('/article_manage_view', 'View/pages/articles/manage_view.php');
$router->get('/article_show_view', 'View/pages/articles/show_view.php');
$router->get('/list_view', 'View//pages/articles/list_view.php');




// access categories views
$router->get('/categories_create_view', 'View/pages/categories/create_view.php');
$router->get('/categories_edit_view', 'View/pages/categories/edit_view.php');
$router->get('/categories_index_view', 'View/pages/categories/index_view.php');
$router->get('/categories_manage_view', 'View/pages/categories/manage_view.php');
$router->get('/categories_show_view', 'View/pages/categories/show_view.php');


// access errors page

$router->get('/404', 'View/errors/404.php');

// access session controllers
$router->get('/logout', 'Controllers/session/destroy.php');
$router->get('/login', 'View//pages/users/index_view.php');







