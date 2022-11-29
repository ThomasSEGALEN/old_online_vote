<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('groups', GroupController::class);

    Route::resource('sessions', SessionController::class);
    
    Route::resource('sessions.votes', VoteController::class, [
        'names' => 
            [
                'index' => 'votes.index',
                'create' => 'votes.create',
                'store' => 'votes.store',
                'show' => 'votes.show',
                'edit' => 'votes.edit',
                'update' => 'votes.update',
                'destroy' => 'votes.destroy'
            ]
    ]);
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
