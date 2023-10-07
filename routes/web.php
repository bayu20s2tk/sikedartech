<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseCommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MoneyTransferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductEmoneyController;
use App\Http\Controllers\ProductGamesController;
use App\Http\Controllers\ProductInternetController;
use App\Http\Controllers\ProductPlnController;
use App\Http\Controllers\ProductPulsaController;
use App\Http\Controllers\ProductTelevisionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebHookController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [LandingController::class, 'welcome'])->name('landing.welcome');

Route::get('/kelas', [LandingController::class, 'course'])->name('landing.course');
Route::get('/kelas/{course}', [CourseController::class, 'show'])->name('course.show');

Route::get('/artikel', [LandingController::class, 'blog'])->name('landing.blog');
Route::get('/artikel/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/course', CourseController::class)->names('course')->except('show');
    Route::post('course/add-hero', [CourseController::class, 'addHero'])->name('course.addHero');
    Route::delete('course/delete-hero/{id}', [CourseController::class, 'deleteHero'])->name('course.deleteHero');

    Route::resource('/course-category', CourseCategoryController::class)->names('courseCategory');
    Route::resource('/course-comment', CourseCommentController::class)->names('courseComment');

    Route::resource('/blog', BlogController::class)->names('blog')->except('show');
//    Route::post('blog/add-hero', [BlogController::class, 'addHero'])->name('blog.addHero');
//    Route::delete('blog/delete-hero/{blog}/{id}', [BlogController::class, 'deleteHero'])->name('blog.deleteHero');

    Route::resource('/blog-category', BlogCategoryController::class)->names('blogCategory');
    Route::resource('/blog-comment', BlogCommentController::class)->names('blogComment');

    Route::resource('/gallery', GalleryController::class)->names('gallery');
    Route::resource('/information', InformationController::class)->names('information');

    Route::resource('/user', UserController::class)->names('user');
    Route::post('/users/reset-password/{user}', [UserController::class, 'resetPassword'])->name('user.passwordReset');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::resource('/setting', AppSettingController::class)->names('setting');
});
