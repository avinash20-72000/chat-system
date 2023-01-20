<?php

/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::prefix('notification')->group(function () {
    Route::get('/read_flag/{notification}',                 [NotificationController::class,'set_read_status'])->name('notificationReadStatus');
    Route::get('/clear',                                    [NotificationController::class,'clear_notification'])->name('clearNotification');
    Route::get('/get',                                      [NotificationController::class,'get_notification'])->name('getNotification');
});
