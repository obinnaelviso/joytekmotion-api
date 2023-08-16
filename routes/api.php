<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers\Api\\'
    ],
    static function () {
        Route::post('/frontend/page-visit', 'Api\PageVisitController@store')->name('api.page-visit.store');
        Route::post('/frontend/contact-us', 'Api\PageVisitController@store')->name('api.page-visit.store');
        Route::post('/frontend/subscribe', 'Api\PageVisitController@store')->name('api.page-visit.store');
    }
);
