<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;


// admin login route 
Route::get('/admin-login', [LoginController::class, 'AdminLogin'])->name('admin.login.page');


Route::post('/admin-login', [LoginController::class, 'AdminSignup'])->name('admin.login');

// Route::get('/admin/dashboard', [HomeController::class, 'Admin'])->middleware('is_admin')->name('admin.dashboard');


// group route 
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {


    Route::get('/admin/dashboard', 'AdminController@Admin')->name('admin.dashboard');

    //admin logout rotue
    Route::get('/admin/logout', 'AdminController@AdminLogout')->name('admin.logout');

    //admin password change
    Route::get('/admin/password/change', 'AdminController@AdminPasswordChange')->name('admin.password.change');

        //admin password update
        Route::post('/admin/password/update', 'AdminController@AdminPasswordUpdate')->name('admin.password.update');


    //category route
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@Store')->name('category.store');
        Route::get('/delete/{id}', 'CategoryController@Destroy')->name('category.delete');
        Route::get('/edit/{id}', 'CategoryController@Edit');
        Route::post('/update', 'CategoryController@Update')->name('category.update');
    });

    //coupon route
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', 'CouponController@Index')->name('coupon.index');
        Route::post('/store', 'CouponController@Store')->name('coupon.store');
        Route::get('/delete/{id}', 'CouponController@Destroy')->name('coupon.delete');
        Route::get('/edit/{id}', 'CouponController@Edit');
        Route::post('/update', 'CouponController@Update')->name('coupon.update');
    });


    //blog route
    Route::group(['prefix' => 'blog-category'], function () {
        Route::get('/', 'BlogController@BlogcatIndex')->name('blog_category.index');
        Route::post('/store', 'BlogController@BlogcatStore')->name('blog.cat.store');
        Route::get('/delete/{id}', 'BlogController@BlogcatDestroy')->name('blog.cat.delete');
        Route::get('/edit/{id}', 'BlogController@BlogcatEdit');
        Route::post('/update', 'BlogController@BlogcatUpdate')->name('blog.cat.update');
    });


    //blog route
    Route::group(['prefix' => 'blog-post'], function () {
        Route::get('/', 'BlogController@BlogpostIndex')->name('blog_post.index');
        Route::post('/store', 'BlogController@BlogpostStore')->name('blog.post.store');
        Route::get('/delete/{id}', 'BlogController@BlogpostDestroy')->name('blog.post.delete');
        Route::get('/edit/{id}', 'BlogController@BlogpostEdit');
        Route::post('/update', 'BlogController@BlogpostUpdate')->name('blog.post.update');
    });

    //setting route
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/website', 'SettingsController@Websiteindex')->name('admin.website.index');

        Route::post('/website/update', 'SettingsController@WebsiteUpdate')->name('admin.website.update');

        Route::get('/mail', 'SettingsController@MailIndex')->name('admin.mail.index');

        Route::post('/mail/update', 'SettingsController@MailUpdate')->name('admin.mail.update');

        Route::get('/page', 'SettingsController@PageIndex')->name('admin.page.index');

        Route::get('/page/create', 'SettingsController@PageCreate')->name('admin.page.create');

        Route::post('/page/store', 'SettingsController@PageStore')->name('admin.page.store');

        Route::get('/page/edit/{id}', 'SettingsController@PageEdit')->name('admin.page.edit');

        Route::post('/page/update', 'SettingsController@PageUpdate')->name('admin.page.update');

        Route::get('/page/delete/{id}', 'SettingsController@PageDelete')->name('admin.page.delete');
    });

    // brand route 
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::post('/store', 'BrandController@Store')->name('brand.store');
        Route::get('/delete/{id}', 'BrandController@Destroy')->name('brand.delete');
        Route::get('/edit/{id}', 'BrandController@Edit');
        Route::post('/update', 'BrandController@Update')->name('brand.update');
    });

    // product route 
    Route::group(['prefix' => 'product'], function () {
        Route::get('/create', 'ProductController@Create')->name('product.create');
        Route::get('/view/{id}', 'ProductController@view')->name('product.view');
        Route::post('/store', 'ProductController@Store')->name('product.store');
        Route::get('/index', 'ProductController@Index')->name('product.index');
        Route::get('/edit/{id}', 'ProductController@Edit')->name('product.edit');
        Route::post('/update', 'ProductController@Update')->name('product.update');
        Route::get('/delete/{id}', 'ProductController@Delete')->name('product.delete');
        Route::get('/not-featured/{id}', 'ProductController@Not_Featured');
        Route::get('/featured/{id}', 'ProductController@Featured');
        Route::get('/inspired-no/{id}', 'ProductController@NO_Inspired');
        Route::get('/inspired-yes/{id}', 'ProductController@Inspired');
        Route::get('/status-deactive/{id}', 'ProductController@Status_Deactive');
        Route::get('/status-active/{id}', 'ProductController@Status_Active');
    });

    // order route 
    Route::group(['prefix' => 'Order'], function () {
        Route::get('/index', 'OrderController@Index')->name('admin.order.index');
        Route::get('/edit/{id}', 'OrderController@Edit')->name('admin.order.edit');
        Route::post('/update', 'OrderController@Update')->name('admin.order.update');
        Route::get('/delete/{id}', 'OrderController@Delete')->name('admin.order.delete');
        Route::get('/view/{id}', 'OrderController@View')->name('admin.order.view');
    });


    // report route 
    Route::group(['prefix' => 'report'], function () {
        Route::get('/order', 'ReportController@OrderReportIndex')->name('order.report.index');
        Route::get('/order/print', 'ReportController@OrderReportPrint')->name('order.report.print');
    });

    //user role route
    Route::group(['prefix' => 'role'], function () {
        Route::get('/index', 'RoleController@IndexRole')->name('index.role');
        Route::get('/create', 'RoleController@CreateRole')->name('create.role');
        Route::post('/store', 'RoleController@StoreRole')->name('store.role');
        Route::get('/delete/{id}', 'RoleController@DeleteRole')->name('role.delete');
        Route::get('/edit/{id}', 'RoleController@EditRole')->name('role.edit');
        Route::post('/update', 'RoleController@UpdateRole')->name('update.role');
    });

    //messages route
    Route::group(['prefix' => 'message'], function () {
        Route::get('/index', 'MessageController@Index')->name('admin.message.index');
        Route::get('/view/{id}', 'MessageController@View')->name('single.message.view');
        Route::get('/delete/{id}', 'MessageController@Delete')->name('single.message.delete');
    });
});
