<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontend\CategoriesController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\ProductsController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



Route::get('/test-mail', function () {
    Mail::raw('Test Email', function ($message) {
        $message->to('mohamed.shams1998@gmail.com')
            ->subject('Test');
    });

    return 'Mail sent';
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Public Routes
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoriesController::class, 'show'])->name('categories.show');

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');
Route::get('/products/new', [ProductsController::class, 'newProducts'])->name('products.new');
Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('products.show');


// Auth Routes
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])
        ->name('cart.applyCoupon');
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.placeOrder');
    Route::get('/payment/{order}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/callback', [PaymentController::class, 'callback']);
});


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('CheckUser')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::post('categories/bulk', [\App\Http\Controllers\Backend\CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');
    Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
    Route::post('products/bulk', [\App\Http\Controllers\Backend\ProductController::class, 'bulkDelete'])->name('products.bulkDelete');
    Route::get('products/export', [\App\Http\Controllers\Backend\ProductController::class, 'exportAllProducts'])->name('products.exportAllProducts');
    Route::get('products/search', [\App\Http\Controllers\Backend\ProductController::class, 'search'])->name('products.search');
    Route::get('products/count', [\App\Http\Controllers\Backend\ProductController::class, 'productCount'])->name('products.count');
    Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);
    Route::post('coupons/bulk', [\App\Http\Controllers\Backend\CouponController::class, 'bulkDelete'])->name('coupons.bulkDelete');
    Route::resource('coupons', \App\Http\Controllers\Backend\CouponController::class);
    Route::resource('users', \App\Http\Controllers\Backend\UserController::class);

    Route::post('installment-plans/bulk', [\App\Http\Controllers\Backend\InstallmentPlanController::class, 'bulkDelete'])->name('installment-plans.bulkDelete');
    Route::resource('installment-plans', \App\Http\Controllers\Backend\InstallmentPlanController::class);
    Route::post('installment-plans/{installmentPlan}/soft-delete', [\App\Http\Controllers\Backend\InstallmentPlanController::class, 'softDelete'])->name('installment-plans.softDelete');
    Route::get('inventories', [\App\Http\Controllers\InventoryMovementController::class, 'index'])->name('inventories.index');
});


// Error for URL

Route::fallback(function () {
    return redirect('/');
});
