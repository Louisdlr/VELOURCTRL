<?php 
require '../vendor/autoload.php';
use Router\Router;

$url = $_GET['url'];
define('VIEWS',dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views'.DIRECTORY_SEPARATOR);

define('SCRIPTS',dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR );
define('DB_NAME',"e_commerce");
define('DB_HOST',"127.0.0.1");
define('DB_USER',"root");
define('DB_PASSWORD',"");
define('IMG',dirname($_SERVER['SCRIPT_NAME']) .DIRECTORY_SEPARATOR . 'img'.DIRECTORY_SEPARATOR);

$router = new Router($url); 

// Exemple de route simple POST ou GET : 
// $router->get/post('url','chemain du controller + @ methode');
$router -> get('/login', 'App\controllers\connectionController@login'); 
$router->get('/deconnection', 'App\controllers\connectionController@logout');
$router -> post('/login', 'App\controllers\UserController@loginUser'); 
$router -> get('/signUp', 'App\controllers\connectionController@create'); 
$router -> post('/signUp', 'App\controllers\UserController@createUser'); 

$router->get('/homepage', 'App\controllers\HomepageController@index');
$router->post('/homepage/search', 'App\controllers\HomepageController@search');

$router->get('/orderManagement/orders', 'App\controllers\OrderManagementController@index');
$router->get('/orderManagement/orders/:id','App\controllers\OrderManagementController@show');
$router->post('/orderManagement/orders/delete/:id','App\controllers\OrderManagementController@destroy');
$router->post('/orderManagement/orders/validate/:id','App\controllers\OrderManagementController@accept');
$router->post('/orderManagement/orders/validateOrder/:id','App\controllers\OrderManagementController@validate');
$router->post('/orderManagement/orders/archive/:id','App\controllers\OrderManagementController@archive');
$router->get('/orderManagement/archived', 'App\controllers\OrderManagementController@archived');
$router->post('/orderManagement/search', 'App\controllers\OrderManagementController@search');

$router -> get('/productManagement', 'App\controllers\productManagementController@index');
$router -> post('/productManagement/search', 'App\controllers\productManagementController@research');
$router -> get('/productManagement/edit/:id', 'App\controllers\productManagementController@edit');
$router -> post('/productManagement/edit/:id', 'App\controllers\productManagementController@update');
$router -> post('/productManagement/delete/:id', 'App\controllers\productManagementController@destroy');
$router -> get('/productManagement/create', 'App\controllers\productManagementController@create');
$router -> post('/productManagement/create', 'App\controllers\productManagementController@createProduct');

$router->get('/user_management','App\controllers\UserManagementController@index');
$router->post('/user_management/delete/:id','App\controllers\UserManagementController@destroy');
$router->post('/user_management/edit/:id','App\controllers\UserManagementController@update');
$router->post('/user_management/search/','App\controllers\UserManagementController@research');
$router->get('/user_management/:id','App\controllers\UserManagementController@show');

$router->get('/categoryManagement','App\controllers\CategoryManagementController@index');
$router->post('/categoryManagement/delete/:id','App\controllers\CategoryManagementController@destroy');
$router->post('/categoryManagement/search/','App\controllers\CategoryManagementController@research');
$router->post('/categoryManagement/edit/:id', 'App\controllers\CategoryManagementController@update');
$router->get('/categoryManagement/create', 'App\controllers\CategoryManagementController@create');
$router->post('/categoryManagement/create', 'App\controllers\CategoryManagementController@createCategory');

$router->post('/order','App\controllers\orderController@index');

$router->post('/order/create','App\controllers\orderController@create');

$router->get('/product/:id', 'App\controllers\productController@show');

$router->get('/cart','App\controllers\CartController@index');

$router->get('/userOrder','App\controllers\userOrderController@index');
$router->get('/userOrder/:id','App\controllers\userOrderController@show');

$router->get('/user/edit/:id', 'App\controllers\UserController@edit');
$router->post('/user/edit/:id', 'App\controllers\UserController@update');
$router->get('/user/editMdp/:id', 'App\controllers\UserController@editMdp');
$router->post('/user/editMdp/:id', 'App\controllers\UserController@updateMdp');

$router->get('/address/create/:id', 'App\controllers\UserController@show_CreateAddress');
$router->post('/address/create/:id', 'App\controllers\UserController@createAddress');
$router->get('/address/edit/:id', 'App\controllers\UserController@show_EditAddress');
$router->post('/address/edit/:id', 'App\controllers\UserController@editAddress');

try{
     $router->run(); 
} catch(\Exception $e) {
    echo $e->getMessage();   
}   
