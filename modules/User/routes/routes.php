<?php
use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Middlewares\DemoMiddleware;

// Route::middleware(DemoMiddleware::class)->get('/user' , function () {
//     return config('config.test');
// });

Route::namespace('Modules\User\src\Http\Controllers')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::resource('/', UserController::class);
        Route::get('/{id}', 'UserController@show');
        Route::get('/create', 'UserController@create');
    });
});