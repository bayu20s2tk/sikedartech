<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseCommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseItemController;
use App\Http\Controllers\CourseSubscribeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectBidController;
use App\Http\Controllers\ProjectBillingController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectChatController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
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
Route::get('/proyek', [LandingController::class, 'project'])->name('landing.project');

Route::get('/artikel', [LandingController::class, 'blog'])->name('landing.blog');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kelas/{course}', [LandingController::class, 'courseShow'])->name('landing.course.show');
    Route::get('/proyek/{project}', [LandingController::class, 'projectShow'])->name('landing.project.show');
    Route::get('/artikel/{blog}', [LandingController::class, 'blogShow'])->name('landing.blog.show');

    Route::resource('/course', CourseController::class)->names('course');
//    Route::post('/course/subscribe/{course}', [CourseController::class, 'subscribe'])->name('course.subscribe');
    Route::post('/course/add-hero', [CourseController::class, 'addHero'])->name('course.addHero');
    Route::delete('/course/delete-hero/{id}', [CourseController::class, 'deleteHero'])->name('course.deleteHero');

    Route::resource('/course-subscribe', CourseSubscribeController::class)->names('courseSubscribe');
    Route::resource('/course-item', CourseItemController::class)->names('courseItem');
    Route::resource('/course-category', CourseCategoryController::class)->names('courseCategory');
    Route::resource('/course-comment', CourseCommentController::class)->names('courseComment');
    Route::post('/course-comment/like/{courseComment}', [CourseCommentController::class, 'like'])->name('courseComment.like');
    Route::post('/course-comment/dislike/{courseComment}', [CourseCommentController::class, 'dislike'])->name('courseComment.dislike');

    Route::resource('/project', ProjectController::class)->names('project');
    Route::post('project/add-media', [ProjectController::class, 'addMedia'])->name('project.addMedia');
    Route::delete('project/delete-media/{id}', [ProjectController::class, 'deleteMedia'])->name('project.deleteMedia');

    Route::resource('/project-chat', ProjectChatController::class)->names('projectChat');
    Route::resource('/project-category', ProjectCategoryController::class)->names('projectCategory');
    Route::resource('/project-bid', ProjectBidController::class)->names('projectBid');
    Route::resource('/project-billing', ProjectBillingController::class)->names('projectBilling');

    Route::resource('/blog', BlogController::class)->names('blog');
    Route::post('/blog-comment/like/{blogComment}', [BlogCommentController::class, 'like'])->name('blogComment.like');
    Route::post('/blog-comment/dislike/{blogComment}', [BlogCommentController::class, 'dislike'])->name('blogComment.dislike');

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
