<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ReviwController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('frontend.index');
})->middleware('tract_visitor');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// sign up page show 
Route::get('/Sign-up', [LoginController::class, 'Signup'])->name('signup.page');

// login page show
Route::get('Sign-in/', [LoginController::class, 'UserLogin'])->name('login.page');

// login route 
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');

// Route::post('ecommerce/user/password-change', [ProfileController::class, 'UserPasswordChange'])->name('change.user.password');
Route::group(
    ['namespace' => 'App\Http\Controllers\Frontend', 'middleware' => 'auth'],
    function () {
        Route::post('/user/review', 'ReviwController@ReviewStore')->name('user.review.store');
    }
);

//all frontend rotue
Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    Route::get('/', 'IndexController@Index')->name('index');
    Route::get('/log-out', 'Logincontroller@UserLogout')->name('user.logout');

    //user dashboard 
    Route::get('/user/dashborad', 'ProfileController@Dashborad')->name('user.dashboard');

    //user settings
    Route::get('/user/settings', 'ProfileController@UserSettings')->name('user.settings');

    //user settings
    Route::post('/change/user-password', 'ProfileController@UserPasswordChange')->name('change.user.password');

    //user shipping address
    Route::post('/user/shipping-address', 'ProfileController@ShippingStore')->name('shipping.store');


    //user password change
    Route::post('/user/password-change', 'ProfileController@UserPasswordChange')->name('user.password.change');

    // products details rotue 
    // Route::get('/product/details/{slug}', 'IndexController@ProductDetails')->name('product.details');

    //shop category page show
    Route::get('/shop/category/page', 'CategoryProductController@ShopCategory')->name('shop.category');

    //category wise products
    Route::get('/shop/category/product/{id}', 'CategoryProductController@CategoryWiseProduct')->name('category.product');


    //brand wise products
    Route::get('/shop/brand/product/{id}', 'CategoryProductController@BrandWiseProduct')->name('brand.product');


    //products details
    Route::get('/shop/product/details/{id}', 'IndexController@ProductDetails')->name('product.details');

    //serarch product route
    Route::post('/shop/product/search', 'IndexController@SearchProduct')->name('srarch.product');

    //wishlist route
    Route::get('/product/wishlist/add/{id}', 'WishlistController@WishlistAdd')->name('wishlist.add');
    Route::get('/product/my-wishlist', 'WishlistController@MyWishlist')->name('my.wishlist');
    Route::get('/product/remove-wishlist/{id}', 'WishlistController@RemoveWishlist')->name('remove.wishlist');

    // comment store 
    Route::post('/shop/product/comment', 'CommentController@CommentStore')->name('user.comment');

    // comment reply store 
    Route::post('/shop/product/comment-reply', 'CommentController@CommentreplyStore')->name('comment.reply');

    // blog comment store 
    Route::post('/shop/blog/comment', 'CommentController@BlogCommentStore')->name('blog_comment.store');

    // review store 
    Route::post('/shop/product/review', 'ReviewController@ReviewStore')->name('user.review');

    // product cart route
    Route::post('/product/add-to-cart', 'CartController@AddtoCart')->name('product.add.cart');

    Route::get('/product/add-to-cart/{id}', 'CartController@AddsingleCart')->name('pdsingle.add.cart');

    //cart list route
    Route::get('/product/cart-list', 'CartController@CartList')->name('cart.list');
    // cart item remove 
    Route::get('/remove/cart-item/{id}', 'CartController@Removecartitem')->name('remove.cartitem');
    // cart qty update 
    Route::get('cart-qty/update/{rowId}/{qty}', 'CartController@CartQtyupdate');

    // route for newsletter 
    Route::post('newsletter/', 'NewsletterController@Newsletter')->name('newsletter');

    //checkout route
    Route::get('/oreder/checkout', 'CheckoutController@Checkout')->name('order.checkout');

    //route for coupon 
    Route::post('/coupon/apply', 'CheckoutController@CouponApply')->name('apply.coupon');

    //route for order placed 
    Route::post('/order/placed', 'CheckoutController@OrderPlaced')->name('order.placed');

    // order truck route 
    Route::get('/order/truck', 'OrderTruckController@OrderTruck')->name('order.truck');

    // order search route 
    Route::get('/order/search', 'OrderTruckController@OrderSearch');

    //contact route 
    Route::get('/customer/contact', 'ContactController@Index')->name('contact.index');

    //contact store route 
    Route::post('/customer/message-send', 'ContactController@Store')->name('contact.store');

    //frontend blog index route
    Route::get('/blog', 'FrontendBlogController@BlogIndex')->name('blog.index');

    //frontend blog details route
    Route::get('/blog/details/{id}', 'FrontendBlogController@BlogDetails')->name('blog.details');

    //frontend blog details route
    Route::post('/blog/search', 'FrontendBlogController@BlogSearch')->name('blog.search');

    //payment route
    Route::post('success', 'CheckoutController@success')->name('success');
    Route::post('fail', 'CheckoutController@fail')->name('fail');
    Route::get('cancel', 'CheckoutController@cancel')->name('cancel');

    // all footer routes here 
    Route::get('/info about/ confidence cart/{id}', 'FrontendDetails@Info')->name('info');
});
