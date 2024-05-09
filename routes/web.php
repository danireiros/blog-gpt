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
use App\Http\Controllers\OpenAi\TextModelController;
use App\Http\Controllers\OpenAi\ImageModelController;
use App\Http\Controllers\Web\DashboardHomeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Blog\PostController as BlogPostController;
use App\Http\Controllers\OpenAi\OpenAiController as OpenAiPostController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Web\WebLinkController;
use App\Http\Controllers\Dashboard\UserController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'checkAdminRole',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia('Dashboard/Index');
    })->name('dashboard');

    // usuarios
    Route::get('/user',                                     [UserController::class, 'index'])->name('user.index');
    Route::post('/user/ban/{user}',                         [UserController::class, 'ban'])->name('user.ban');

    // rutas
    Route::resource('/author',                              AuthorController::class);
    Route::resource('/category',                            CategoryController::class);
    Route::resource('/post',                                PostController::class);
    Route::post('/post/upload/{post}',                      [PostController::class, 'upload'])->name('post.upload');
    Route::get('/post/file/upload/{post}',                  [PostController::class, 'create_file'])->name('post.create.upload');
    Route::get('/post/custom/create',                       [PostController::class, 'customPostCreate'])->name('post.create.custom');
    Route::post('/post/custom/store',                       [PostController::class, 'customPostStore'])->name('post.store.custom');

    // openai
    Route::get('/openai',                                   [OpenAiPostController::class, 'index'])->name('openai.index');
    Route::get('/openai/post/random',                       [PostController::class, 'generateRandom'])->name('openai.post.random');

    // tools
    Route::get('/openai/models/text/create',                [OpenAiPostController::class, 'createTextModel'])->name('text.model.create');
    Route::get('/openai/models/image/create',               [OpenAiPostController::class, 'createImageModel'])->name('image.model.create');

    Route::resource('/openai/models/text',                  TextModelController::class);
    Route::resource('/openai/models/image',                 ImageModelController::class);
    Route::post('/openai/models/text/default/{text}',       [TextModelController::class, 'setTextModel'])->name('text.model.default');
    Route::post('/openai/models/image/default/{image}',     [ImageModelController::class, 'setImageModel'])->name('image.model.default');

    // webs
    Route::resource('/web',                     MainController::class);

    Route::get('/web/generate/{webname}',       [MainController::class, 'routeWeb'])->name('web.generate');
    Route::get('/web/link/generate/{link}',     [MainController::class, 'generateNewFromLink'])->name('web.link.generate');
    Route::resource('/weblink',                 WebLinkController::class)->only('destroy');
    Route::delete('/weblink',                   [WebLinkController::class, 'destroyAll'])->name('weblink.remove');
});

// public
Route::get('/',                         [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/category/{category}',      [BlogPostController::class, 'category'])->name('blog.category');
Route::get('/blog/{post}',              [BlogPostController::class, 'show'])->name('blog.post.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'CheckNotBannedUser',
])->group(function () {
    Route::resource('/comments',            CommentController::class);
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
});
