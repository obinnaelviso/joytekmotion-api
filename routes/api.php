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
        'namespace' => 'App\Http\Controllers\Api\V1',
        'as' => 'api.v1.'
    ],
    static function () {
        // Route::post('/frontend/page-visit', 'PageVisitController@store')->name('page-visit.store');
        Route::post('/contact-us', ContactUsController::class)->name('contact-us');
        // Route::post('/frontend/subscribe', 'PageVisitController@store')->name('subscribe');
    }
);
