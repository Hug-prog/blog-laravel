<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\User;

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
    return Inertia::render('Auth/Login');
});

// user protected routes
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'user'])->name('dashboard');

/* Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    
    
}); */

// same route user/admin
//******************************************************* */

// profile user
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


//article
//home
Route::get('article/index', [ArticleController::class,'index'])->name('Article.index');
//show
Route::get('article/{id}/show', [ArticleController::class,'show'])->name('Article.show');

//comments
//create
Route::get('comment/{id}/create', [CommentController::class,'create'])->name('Comment.Create');
Route::post('comment/create', [CommentController::class,'store'])->name('Comment.store');




//******************************************************* */


// admin protected routes

Route::get('/adminDashboard', function () {
    return Inertia::render('adminDashboard',['users' =>User::all()]);
})->middleware(['auth', 'admin'])->name('adminDashboard');


Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    

   // update role user
   Route::get('user/{id}/edit', [RoleController::class,'editPage']);
   Route::put('user/{id}/edit', [RoleController::class,'edit'])->name('edit');

   // article
   // edit
   Route::get('article/{id}/edit', [ArticleController::class,'edit'])->name('Article.edit');
   Route::put('article/{id}/edit', [ArticleController::class,'update'])->name('Article.update');

   // create 
   Route::get('article/create', [ArticleController::class,'create'])->name('Article.Create');
   Route::post('article/create', [ArticleController::class,'store'])->name('Article.store');
    
   //delete
   Route::get('article/{id}/delete', [ArticleController::class,'destroy'])->name('Article.destroy');

});



require __DIR__.'/auth.php';
