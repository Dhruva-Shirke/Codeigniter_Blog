<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// route grouping
$routes->group("admin", ["namespace" => "Admin\Controllers", "filter" => "group:admin"], static function ($routes) {
    $routes->get('users', 'Users::index');
    $routes->get('users/(:num)', 'Users::show/$1');
    $routes->post('users/(:num)/toggle-ban', 'Users::toggleBan/$1');
    $routes->match(['get', 'post'], 'users/(:num)/groups', 'Users::groups/$1');
    $routes->match(['get', 'post'], 'users/(:num)/permissions', 'Users::permissions/$1');
});



// old method need admin prefix and full namespace is \Admin\Controllers\
// $routes->get('admin/users', '\Admin\Controllers\Users::index');
// $routes->get('admin/users/(:num)', '\Admin\Controllers\Users::show/$1');

// defining namespace separately
// $routes->get('admin/users/(:num)', 'Users::show/$1',["namespace"=>"Admin\Controllers"]); 