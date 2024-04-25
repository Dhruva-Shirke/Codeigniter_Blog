<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

service('auth')->routes($routes);
// $routes->get('/articles', 'Articles::index');
// $routes->get('/articles/(:num)', 'Articles::showArticle/$1');
// $routes->get('/articles/new', 'Articles::new', ['as' => 'newArticle']);
// $routes->post('/articles', 'Articles::create');
// $routes->get('/articles/(:num)/edit', 'Articles::edit/$1');
// $routes->patch('/articles/(:num)', 'Articles::update/$1');
// // $routes->get('/articles/delete/(:num)', 'Articles::delete/$1');
// // $routes->post('/articles/delete/(:num)', 'Articles::delete/$1');
// // $routes->match(["get", "delete"], '/articles/delete/(:num)', 'Articles::delete/$1');

// // implementing restFul delete now
// $routes->delete('/articles/(:num)', 'Articles::delete/$1');
// $routes->get('/articles/(:num)/delete', 'Articles::confirmDelete/$1');

// using resource routing replaces all restful routes with single value
// named routes dont work with resource ie 'as' => 'newArticle' for Articles::new
// $routes->resource("articles"); //generates any char placeholder ie(.*)

// $routes->resource("articles", ['placeholder' => '(:num)']); // numeric placeholder for id

// $routes->get('/articles/(:num)/delete', 'Articles::confirmDelete/$1');  // this isnt a restful route so manual defining

$routes->get('/set-password', 'Password::set');

$routes->post('/set-password', 'Password::update');

//single route routing
// $routes->resource("articles", ['placeholder' => '(:num)', 'filter' => 'login']);

// grouped filter routing
$routes->group('', ['filter' => 'login'], static function ($routes) {
    $routes->resource("articles", ['placeholder' => '(:num)']);
    $routes->get('/articles/(:num)/delete', 'Articles::confirmDelete/$1');
    $routes->get('/articles/(:num)/image/edit', 'Article\Image::new/$1');
    $routes->post('/articles/(:num)/image/create', 'Article\Image::create/$1');
    $routes->get('/articles/(:num)/image', 'Article\Image::get/$1');
    $routes->post('/articles/(:num)/image/delete', 'Article\Image::delete/$1'); // last route
});
