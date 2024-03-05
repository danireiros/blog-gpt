<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Author\DetailController;
use App\Http\Controllers\Author\PersonController;
use App\Http\Controllers\Author\CompanyController;
use App\Http\Controllers\Author\GeneralController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // rutas
    Route::resource('/category',            CategoryController::class);
    Route::resource('/post',                PostController::class);
    Route::post('/post/upload/{post}',      [PostController::class, 'upload'])->name('post.upload');
    Route::get('/post/file/upload/{post}',  [PostController::class, 'create_file'])->name('post.create.upload');
});

Route::group([
    'prefix' => 'author',
    'middleware' => [
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ]
], function() {
    // rutas
    Route::resource('author-general',   GeneralController::class); // ->only(['create', ... ])
    Route::resource('author-company',   CompanyController::class); 
    Route::resource('author-person',    PersonController::class); 
    Route::resource('author-detail',    DetailController::class); 
});