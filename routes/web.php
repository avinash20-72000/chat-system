<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Http\Controllers\UserManagement\ModuleController;
use App\Http\Controllers\UserManagement\PermissionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('admin.layouts.master');
// })->middleware(['auth'])->name('dashboard');
Route::get('/', function () {
    return view('admin.layouts.master');
})->middleware(['auth'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

Auth::routes();
Route::group(['middleware'=>['auth']],function()
{
    // Route::get('/',                                     'DashboardController@index')->name('dashboard');
    Route::resource('user',                 UserController::class);
    Route::resource('role',                 RoleController::class);
    Route::resource('permission',           PermissionController::class);
    Route::resource('module',               ModuleController::class);
    Route::post('role/assign',              [UserController::class,'assignRoles'])->name('assignRole');

    //chat

    Route::get('chat-user',                 [ChatController::class,'chats'])->name('getUsers');
    Route::get('message-box/{id?}',         [ChatController::class,'messageBox'])->name('messageBox');
    Route::post('message',                  [ChatController::class,'saveMessage'])->name('saveMessage');
});


