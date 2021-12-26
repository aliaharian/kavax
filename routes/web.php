<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/* Pages */
Route::get('/', 'HomeController@index')->name('home');

/* Contact */
Route::get('contact-us', 'ContactUs\ContactUsController@show');
Route::post('contact-us', 'ContactUs\ContactUsController@store')->name('ContactUs.store');

/* Career */
Route::get('career', 'Career\CareerController@show_all');
Route::get('career/{slug}', 'Career\CareerController@show');

/* Blog */
Route::get('blog', 'Blog\BlogController@show_all');
Route::get('blog/{slug}', 'Blog\BlogController@show');

/* Services */
Route::get('services/{slug}', 'Services\ServicesController@show');

/* Request Services */
Route::get('services-request/', 'Services\ServiceRequestController@show');
Route::post('services-request', 'Services\ServiceRequestController@store')->name('ServiceRequest.store');
Route::get('services-request/mail', 'Services\ServiceRequestController@mail');

/* Only User Logged In */
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('your-account', 'Profile\ProfileController@youraccount');
    });

    Route::group(['middleware' => ['can:isManager']], function () {
        /* Dashboard Route */
        Route::group(['prefix' => 'dashboard'], function () {
            /* Dashboard */
            Route::get('/', 'Dashboard\DashboardController@index');

            /* Services */
            Route::resource('services', 'Services\ServicesController');

            /* Portfolio */
            Route::resource('portfolio', 'Services\PortfolioController');

            /* Career */
            Route::resource('career', 'Career\CareerController');

            /* Other Pages */
            Route::resource('other-pages', 'OtherPages\OtherPagesController');

            /* Blog */
            Route::resource('blog', 'Blog\BlogController');

            /* Request Service */
            Route::resource('services-request', 'Services\ServiceRequestController');

            /* Contacts */
            Route::resource('contacts', 'ContactUs\ContactUsController');

            /* Users Controller */
            Route::resource('users', 'Dashboard\Users\UsersController');
            Route::post('users/destroy', 'Dashboard\Users\UsersController@destroy')->name('users.destroy');

            /* CKEditor Image Upload */
            Route::post('ckeditor/upload/{path}', 'Dashboard\CKEditorController@upload')->name('ckeditor.image-upload');
        });
    });
});

Auth::routes();

/* Clear Cache */
Route::get('/clear-cache', function () {
//    Artisan::call('migrate');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    return 'DONE';
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

/* Other Pages */
Route::get('{slug}', 'OtherPages\OtherPagesController@show');
