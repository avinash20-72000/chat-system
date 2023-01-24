<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagement\DashboardController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\UserManagement\ModuleController;
use App\Http\Controllers\UserManagement\PermissionController;


// Route::get('/', [HomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

Auth::routes();
Route::group(['middleware'=>['auth']],function()
{
    Route::resource('user',                 UserController::class);
    Route::resource('role',                 RoleController::class);
    Route::resource('permission',           PermissionController::class);
    Route::resource('module',               ModuleController::class);
    Route::post('role/assign',              [UserController::class,'assignRoles'])->name('assignRole');

    Route::get('dashboard',                 [DashboardController::class,'dashboard'])->name('dashboard');

    //chat

    Route::get('/',                         [ChatController::class,'chats'])->name('chatUsers');
    Route::get('message-box/{id?}',         [ChatController::class,'messageBox'])->name('messageBox');
    Route::post('message',                  [ChatController::class,'saveMessage'])->name('saveMessage');
    Route::get('get/user',                  [ChatController::class,'getUsers'])->name('getUsers');
});


