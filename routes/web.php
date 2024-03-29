<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/categories', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/categories/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products'])->name('categories');
Route::get('/categories/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/products/all', [App\Http\Controllers\Frontend\FrontendController::class, 'all'])->name('products.all');
Route::post('search', [App\Http\Controllers\Frontend\FrontendController::class, 'searchProducts']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cart/count', [App\Http\Controllers\Frontend\CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart/price', [App\Http\Controllers\Frontend\CartController::class, 'getCartPrice'])->name('cart.price');
Route::get('/wishlist/count', [App\Http\Controllers\Frontend\WishlistController::class, 'getWishlistCount'])->name('wishlist.count');
Route::post('/payment/{payment_id}', [App\Http\Livewire\Frontend\Checkout\CheckoutShow::class, 'paidOnlineOrder']);
Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankYou']);

Route::get('blog', [App\Http\Controllers\Frontend\BlogController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    //Cart Routes
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::post('cart', [App\Http\Controllers\Frontend\CartController::class, 'addToCart']);
    Route::get('cart/remove/{id}', [App\Http\Controllers\Frontend\CartController::class, 'remove']);
    Route::post('cart/update', [App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');

    //Wishlist Routes
    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::post('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'addToWishlist']);
    Route::get('wishlist/remove/{id}', [App\Http\Controllers\Frontend\WishlistController::class, 'remove']);

    //Checkout Routes
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);

    //Order Routes
    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'view']);

    //Rating Routes
    Route::get('like/{product}', [App\Http\Controllers\Frontend\LikesController::class, 'like'])->name('like');
    Route::get('dislike/{product}', [App\Http\Controllers\Frontend\LikesController::class, 'dislike'])->name('dislike');
    Route::post('comment/{product_id}', [App\Http\Controllers\Frontend\LikesController::class, 'comment'])->name('comment');
    Route::delete('delete-comment/{comment}', [App\Http\Controllers\Frontend\LikesController::class, 'delete'])->name('delete_comment');

    //Blog Routes
    Route::get('blog/create', [App\Http\Controllers\Frontend\BlogController::class, 'create']);
    Route::post('blog/post', [App\Http\Controllers\Frontend\BlogController::class, 'post']);
    Route::post('blog/comment/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'comment'])->name('blog.comment');
    Route::delete('blog/delete-comment/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'delete'])->name('blog.delete_comment');
    Route::get('blogs', [App\Http\Controllers\Frontend\BlogController::class, 'blogs'])->name('blogs');
    Route::get('blogs/{id}/edit', [App\Http\Controllers\Frontend\BlogController::class, 'edit']);
    Route::get('blogs/{id}/delete', [App\Http\Controllers\Frontend\BlogController::class, 'deleteBlog']);
    Route::put('blogs/{id}/update', [App\Http\Controllers\Frontend\BlogController::class, 'update']);

});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //Slider Routes
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index');
        Route::get('sliders/create', 'create');
        Route::post('sliders/create', 'store');
        Route::get('sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'delete');
    });

    //Category Routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{item}/edit', 'edit');
        Route::put('/category/{item}', 'update');
    });

    //Product Routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('/products/{product_id}/delete', 'delete');
        Route::get('/product-image/{product_image_id}/delete', 'deleteImage');
    });

    //Order Routes
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'view');
        Route::put('/orders/{orderId}', 'updateOrderStatus');
    });

});

Route::get('blog/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'view']);
