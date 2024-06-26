<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\StaticticalController;

use App\Http\Controllers\BannerController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::prefix('comment')->group(function () {
    Route::post('/addcomment', [CommentController::class, 'addComment']);
});



Route::middleware('is_admin')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/list-user', [UserController::class, 'listUsers']);
        Route::get('/detailUser/{id}', [UserController::class, 'detailUser']);
        Route::get('/blockUser/{id}', [UserController::class, 'blockUser']);
        Route::get('/index', [UserController::class, 'index'])->name('admin.index');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('admin.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.edit');
        Route::post('/postEdit', [UserController::class, 'postEdit'])->name('admin.postEdit');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('admin.delete');
        Route::get('/', [StaticticalController::class, 'statistical'])->name('admin.home');

    });
});


Route::middleware('is_admin')->group(function () {

    Route::prefix('/admin/product')->group(function () {
        Route::get('/index', [ProductController::class, 'all_product']);
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/add_product', [ProductController::class, 'add_product'])->name('product.add');
        Route::get('/edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update_product']);
    });
});



Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'all_product_user'])->name('product');
    Route::get('/sort-product', [ProductController::class, 'sort__products']);
});


Route::middleware('is_admin')->group(function () {

    Route::prefix('provider')->group(function () {
        Route::get('/index', [ProviderController::class, 'index']);
        Route::get('/create', [ProviderController::class, 'create']);
        Route::post('/add', [ProviderController::class, 'add'])->name('provider/add');
        Route::post('/update/{id}', [ProviderController::class, 'update']);
        Route::get('/edit/{id}', [ProviderController::class, 'edit']);
    });
});

Route::middleware('is_admin')->group(function () {
    Route::prefix('blog')->group(function () {
        Route::get('/index', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create', [BlogController::class, 'create']);
        Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
        Route::post('/add', [BlogController::class, 'add'])->name('blog/add');
        Route::post('/update/{id}', [BlogController::class, 'update']);
        Route::get('/edit/{id}', [BlogController::class, 'edit']);
        Route::post('/uploadimage', [BlogController::class, 'uploadImage'])->name('blog.uploadimage');
    });
});

Route::middleware('is_admin')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/index', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/add', [CategoryController::class, 'add'])->name('category/add');
        Route::post('/update/{id}', [CategoryController::class, 'update']);
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
    });
});


//banner controller
Route::middleware('is_admin')->group(function () {
    Route::prefix('banner')->group(function () {
        Route::get('/index', [BannerController::class, 'index']);
        Route::get('/create', [BannerController::class, 'create']);
        Route::post('/add', [BannerController::class, 'add'])->name('banner/add');
        Route::post('/update/{id}', [BannerController::class, 'update']);
        Route::get('/edit/{id}', [BannerController::class, 'edit']);
        Route::get('/delete/{id}', [BannerController::class, 'delete']);

    });
});
