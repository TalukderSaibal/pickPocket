<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Language create
$routes->get('/languages', 'LanguageController::index');
$routes->get('/languages/add', 'LanguageController::languageAdd');

$routes->post('/langauge_create', 'LanguageController::create');

//Product Units create
$routes->get('/product/units', 'ProductUnitController::index');
$routes->post('/unit_create', 'ProductUnitController::create');
$routes->get('unit/edit/(:any)', 'ProductUnitController::unitEdit/$1');
$routes->post('/unit_update', 'ProductUnitController::update');
$routes->get('/unit/delete/(:any)', 'ProductUnitController::delete/$1');

//Product Attributes
$routes->get('/product/attribute', 'ProductAttributeController::index');
$routes->post('/attribute_create', 'ProductAttributeController::create');
$routes->get('/attribute/edit/(:any)', 'ProductAttributeController::attributeEdit/$1');
$routes->post('/attribute_update', 'ProductAttributeController::update');
$routes->post('/attribute_delete', 'ProductAttributeController::delete');

//Product Variations
$routes->get('/product/variations', 'ProductVariationController::index');
$routes->post('/variation_create', 'ProductVariationController::create');
$routes->get('/variation/edit/(:any)', 'ProductVariationController::variationEdit/$1');
$routes->post('/variation_update', 'ProductVariationController::update');
$routes->post('/variation_delete', 'ProductVariationController::delete');

//Product Brand
$routes->get('/product/brand', 'ProductBrandController::index');
$routes->post('/brand_create', 'ProductBrandController::create');
$routes->get('/brand/edit/(:any)', 'ProductBrandController::brandEdit/$1');
$routes->post('/brand_update', 'ProductBrandController::update');
$routes->post('/brand_delete', 'ProductBrandController::delete');

//Product Categories
$routes->get('product/categories', 'ProductCategoriesController::index');
$routes->post('/category_create', 'ProductCategoriesController::create');
$routes->get('/category/edit/(:any)', 'ProductCategoriesController::categoryEdit/$1');

//Add Product
$routes->get('/add-product', 'ProductController::index');
$routes->post('/product-create', 'ProductController::create');
$routes->post('/product-advance-add', 'ProductController::advanceCreate');
$routes->post('/seo-product-add', 'ProductController::seoCreate');

//Stock/Inventory
$routes->get('/add-stock', 'StockController::stockCreate');
$routes->post('/stock-create', 'StockController::create');
$routes->get('/stock-transfer-create', 'StockController::transferCreate');
$routes->post('/stock-transfer-add', 'StockController::transferAdd');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
