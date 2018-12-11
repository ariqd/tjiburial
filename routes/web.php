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

//Route::get('/contact', 'Frontend\ContactController@index');
Route::post('/contact/send-message', 'Frontend\ContactController@message');

Route::resource('promotion', 'Frontend\PromotionsController');
Route::resource('blog', 'Frontend\BlogController')->only([
    'index', 'show'
]);

// Booking Routes
Route::get('/book', 'Frontend\BookController@index');
Route::get('/book/room-detail/{id}', 'Frontend\BookController@show');
Route::group(['middleware' => 'auth'], function () {
    Route::post('/book', 'Frontend\BookController@reservation');
    Route::get('/book/book-now', 'Frontend\BookController@book');
    Route::post('/book/book-now', 'Frontend\BookController@booking');
    Route::get('/book/payment', 'Frontend\BookController@payment');
    Route::get('/book/payment/getSnapToken', 'Frontend\BookController@token');
    Route::post('/book/payment', 'Frontend\BookController@pay');
    Route::get('/book/checkout', 'Frontend\BookController@snap');
    Route::post('/book/checkout', 'Frontend\BookController@checkout');
    Route::get('/book/finish', 'Frontend\BookController@finish');

//    Route::get('/book/checkout/cc', 'Frontend\BookController@sma');

    Route::get('/profile', 'Frontend\ProfileController@index');
    Route::get('/profile/reservations', 'Frontend\ProfileController@reservations');
    Route::get('/profile/reservations/{id}', 'Frontend\ProfileController@showReservation');
});

// Admin Routes
Route::group(['middleware' => ['auth', 'is_admin']], function() {
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/', 'Backend\AdminController@index');
        Route::resource('bookings', 'Backend\BookingController');

        Route::resource('rooms', 'Backend\BedroomController');
        Route::get('rooms/{id}/images', 'Backend\BedroomController@images');
        Route::post('rooms/images', 'Backend\BedroomController@imagesUpload');

//        Route::resource('rooms', 'Backend\RoomsController');
//        Route::get('rooms/{id}/images', 'Backend\RoomsController@images');
//        Route::post('rooms/images', 'Backend\RoomsController@imagesUpload');

        Route::resource('promotions', 'Backend\PromotionsController');
        Route::get('promotions/{id}/images', 'Backend\PromotionsController@images');
        Route::post('promotions/images', 'Backend\PromotionsController@imagesUpload');

        Route::resource('blog', 'Backend\BlogController');
        Route::get('blog/{id}/images', 'Backend\BlogController@images');
        Route::post('blog/images', 'Backend\BlogController@imagesUpload');

        Route::resource('messages', 'Backend\MessageController');

        Route::get('/settings', 'Backend\SettingsController@index');
        Route::put('/settings/save', 'Backend\SettingsController@save');

        Route::get('/settings/faq', 'Backend\SettingsController@createFaq');
        Route::post('/settings/faq', 'Backend\SettingsController@insertFaq');
        Route::get('/settings/faq/{id}/edit', 'Backend\SettingsController@editFaq');
        Route::put('/settings/faq/{id}', 'Backend\SettingsController@updateFaq');
        Route::delete('/settings/faq/{id}', 'Backend\SettingsController@deleteFaq');

        Route::resource('banners', 'Backend\BannerController');

    });
});
