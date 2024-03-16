<?php

use Inertia\Inertia;
use App\Http\Requests\Author\Author;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Web\MainController;
use App\Http\Controllers\Tools\ImageController;
use App\Http\Controllers\Web\SoymotorController;
use App\Http\Controllers\Author\DetailController;
use App\Http\Controllers\Author\PersonController;
use App\Http\Controllers\Author\CompanyController;
use App\Http\Controllers\Author\GeneralController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\AuthorController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Blog\PostController as BlogPostController;
use App\Http\Controllers\OpenAi\PostController as OpenAiPostController;

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

/* 
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'checkAdminRole',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // rutas
    Route::resource('/author',              AuthorController::class);
    Route::resource('/category',            CategoryController::class);
    Route::resource('/post',                PostController::class);
    Route::post('/post/upload/{post}',      [PostController::class, 'upload'])->name('post.upload');
    Route::get('/post/file/upload/{post}',  [PostController::class, 'create_file'])->name('post.create.upload');

    Route::get('/openai',                   [OpenAiPostController::class, 'index'])->name('openai.index');
    Route::get('/openai/completion',        [OpenAiPostController::class, 'postCompletion'])->name('openai.completion');

    // tools
    Route::get('/image/store', [ImageController::class, 'storeImageFromUrl'])->name('image.store');

    // webs
    Route::resource('/web',                   MainController::class);
    Route::get('/web/generate/{webname}',     [MainController::class, 'routeWeb'])->name('web.generate');

    /* Route::get('/web/gestion/soymotor/f1/{web}',     [SoymotorController::class, 'GenerateWebPost'])->name('SoyMotor.generate');
    Route::get('/web/gestion/soymotor/coches/{web}', [SoymotorController::class, 'GenerateWebPost'])->name('SoyMotor_Coches.generate');
    Route::get('/web/gestion/xataka/{web}',          [SoymotorController::class, 'GenerateWebPost'])->name('Xataka.generate'); */
    /* Route::get('/web/gestion/soymotor/noticia', [SoymotorController::class, 'getNewContent'])->name('SoyMotor.show'); */
});

Route::get('/',                         [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/category/{category}',      [BlogPostController::class, 'category'])->name('blog.category');
Route::get('/blog/{post}',         [BlogPostController::class, 'show'])->name('blog.post.show');



/* Route::group([
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
}); */