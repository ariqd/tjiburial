<?php

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

Route::get('/', 'Frontend\HomeController@index');
Route::get('/features', 'Frontend\FeaturesController@index');
//Route::get('/blog', 'Frontend\BlogController@index');
Route::get('/about', 'Frontend\AboutController@index');
Route::get('/faq', 'Frontend\FaqController@index');
Route::get('/contact', 'Frontend\ContactController@index');

Route::resource('promotion', 'Frontend\PromotionsController');
Route::resource('blog', 'Frontend\BlogController')->only([
    'index', 'show'
]);

// Booking Routes
Route::get('/book', 'Frontend\BookController@index');
Route::group(['middleware' => 'auth'], function () {
    Route::post('/book', 'Frontend\BookController@reservation');
    Route::get('/book/book-now', 'Frontend\BookController@book');
    Route::post('/book/book-now', 'Frontend\BookController@booking');
    Route::get('/book/payment', 'Frontend\BookController@payment');
});

// Admin Routes
Route::group(['middleware' => ['auth', 'is_admin']], function() {
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/', 'Backend\AdminController@index');
        Route::resource('bookings', 'Backend\BookingController');

        Route::resource('rooms', 'Backend\RoomsController');
        Route::get('rooms/{id}/images', 'Backend\RoomsController@images');
        Route::post('rooms/images', 'Backend\RoomsController@imagesUpload');

        Route::resource('promotions', 'Backend\PromotionsController');
        Route::get('promotions/{id}/images', 'Backend\PromotionsController@images');
        Route::post('promotions/images', 'Backend\PromotionsController@imagesUpload');

        Route::resource('blog', 'Backend\BlogController');
        Route::get('blog/{id}/images', 'Backend\BlogController@images');
        Route::post('blog/images', 'Backend\BlogController@imagesUpload');
    });
});