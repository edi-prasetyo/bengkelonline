<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'register' => true,
]);

Route::prefix('member')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/orders', [HomeController::class, 'orders']);
    Route::get('/orders/detail/{code}', [HomeController::class, 'order_detail']);
    Route::get('/wallets', [HomeController::class, 'wallet']);
    Route::get('/topup', [HomeController::class, 'topup_view']);
    Route::post('/struk', [HomeController::class, 'struk']);
    Route::get('/topup/success/{id}', [HomeController::class, 'success']);
    Route::post('/wallets', [HomeController::class, 'topup']);
    Route::get('/profile', [HomeController::class, 'profile']);
    Route::get('/upgrade', [HomeController::class, 'upgrade']);


    Route::get('directory/9f37359d-79bf-4a20-ae3e-a282d709d909/file/{file_download}', [HomeController::class, 'downloadFile']);
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/category', [FrontendController::class, 'categories']);
Route::get('/category/{category_slug}', [FrontendController::class, 'products']);
Route::get('/item/{product_slug}', [FrontendProductController::class, 'detail']);
Route::get('/products', [FrontendProductController::class, 'index']);
Route::get('/booking', [FrontendController::class, 'booking']);
Route::get('/contact', [FrontendController::class, 'contact']);
Route::get('/services', [FrontendServiceController::class, 'index']);
Route::get('/services/{slug}', [FrontendServiceController::class, 'show']);
Route::post('services/fetch-city', [FrontendServiceController::class, 'fetchCity'])->name('fetchCity');
Route::post('services/fetch-model', [FrontendServiceController::class, 'fetchModel'])->name('fetchModel');
Route::get('/sitemap.xml', [FrontendPageController::class, 'sitemap']);

// Cart
Route::get('add-to-cart/{uuid}', [FrontendServiceController::class, 'addToCart'])->name('add.to.cart');
Route::get('cart', [FrontendServiceController::class, 'cart'])->name('cart');
Route::get('checkout', [FrontendServiceController::class, 'checkout'])->name('checkout');
Route::patch('update-cart', [FrontendProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [FrontendProductController::class, 'remove'])->name('remove.from.cart');

Route::post('orders', [FrontendOrderController::class, 'orders'])->name('orders');
Route::get('orders/success/{code}', [FrontendOrderController::class, 'success'])->name('success');


Route::middleware(['auth'])->group(function () {


    Route::get('/payment/{code}', [FrontendOrderController::class, 'payment']);
    Route::get('add-coupon/{id}', [FrontendProductController::class, 'addCoupon']);
});


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Category Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::put('/category/{category}', 'update');
        Route::get('/category/delete/{category}', 'destroy');

        Route::post('category/fetch-types', 'fetchType');
    });
    // Brand Route
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'index');
        Route::get('/brands/create', 'create');
        Route::post('/brands', 'store');
        Route::get('/brands/edit/{brand}', 'edit');
        Route::put('/brands/{brand}', 'update');
        Route::get('/brands/show/{brand_id}', 'show');
        Route::post('/brands/add_model', 'add_model');
    });
    // Type Route
    Route::controller(TypeController::class)->group(function () {
        Route::get('/types', 'index');
        Route::get('/types/create', 'create');
        Route::post('/types', 'store');
        Route::get('/types/edit/{type}', 'edit');
        Route::put('/types/{type}', 'update');
    });
    // Bank Route
    Route::controller(BankController::class)->group(function () {
        Route::get('/banks', 'index');
        Route::get('/banks/create', 'create');
        Route::post('/banks', 'store');
        Route::get('/banks/edit/{bank}', 'edit');
        Route::put('/banks/{bank}', 'update');
    });
    // Bank Route
    Route::controller(CouponController::class)->group(function () {
        Route::get('/coupons', 'index');
        Route::get('/coupons/create', 'create');
        Route::post('/coupons', 'store');
        Route::get('/coupons/edit/{coupon}', 'edit');
        Route::put('/coupons/{coupon}', 'update');
    });
    // Product Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/edit/{product}', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/product-image/delete/{product_image_id}', 'destroyImage');
        Route::get('/products/delete/{product_id}', 'destroy');
        Route::get('/products/testview/', 'testview');
        Route::post('/products/test/', 'test');
    });
    // Order Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/service', 'service');
        Route::get('/orders/service/{id}', 'detail');
        Route::patch('/orders/update-cart', 'update')->name('update.admincart');
        Route::delete('/orders/remove-from-cart', 'remove')->name('remove.from.admincart');
        // cart session
        Route::get('/orders/add-to-cart/{uuid}', 'addToAdminCart')->name('add.to.admincart');
        Route::get('/orders/admincart', 'admincart')->name('admincart');
        Route::get('/orders/admincheckout', 'admincheckout')->name('admincheckout');
        Route::post('/orders/admin_orders', 'adminOrder')->name('adminOrder');
        Route::get('/orders/admin_orders/success/{code}', 'success');

        Route::get('/orders/{order_id}', 'show');
        Route::post('/orders/confirmation/{order_id}', 'confirmation');

        // Fetch User
        Route::post('/orders/services/fetch-car', 'fetchCar')->name('fetchCar');
    });
    // Sliders Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/edit/{slider}', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/delete/{slider}', 'destroy');
    });
    // Option Route
    Route::controller(OptionController::class)->group(function () {
        Route::get('/options', 'index');
        Route::get('/options/edit/{brand}', 'edit');
        Route::post('/options', 'update');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/services', 'index');
        Route::get('/services/create', 'create');
        Route::post('/services', 'store');
        Route::get('/services/edit/{service}', 'edit');
        Route::put('/services/update/{id}', 'update');
        Route::get('/services/show/{service_id}', 'show');
        Route::post('/services/add_item', 'add_item');
        Route::get('/services/edit-item/{item_id}', 'editItem');
        Route::put('/services/update-item/{item_id}', 'updateItem');

        Route::get('/services/delete/{service_id}', 'destroy');
        Route::get('/services/delete-item/{item_id}', 'destroy_item');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index');
        Route::get('/customers/create', 'create');
        Route::post('/customers', 'store');
        Route::get('/customers/edit/{service_id}', 'edit');
        Route::put('/customers/{service_id}', 'update');
        Route::get('/customers/cars/{user}', 'car');
        Route::post('/customers/add-car/{user_id}', 'addCar');
        Route::get('/customers/delete-car/{car_id}', 'destroy');
    });
});
