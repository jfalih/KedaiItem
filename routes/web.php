<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    ChatController,
    DashboardController,
    WelcomeController,
    VendorController,
    UpgradeController,
    ProductController,
    ReviewController,
    CartController,
    VerificationController,
};
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    CategoryController as AdminCategoryController,
    SubcategoryController as AdminSubcategoryController,
};
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/penjual/{seller}/item/{product}',[ProductController::class,'index']);
Route::get('/penjual/{seller}', [VendorController::class,'index'])->name('vendor');

//Auth
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');
Route::post('/phone/verification-notification', [VerificationController::class, 'phone']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/pengaturan');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Link verifikasi telah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/login', [AuthController::class,'authenticate'])->name('login');
Route::post('/register', [AuthController::class,'registerUser'])->name('register');
//Setting
Route::get('/pengaturan', [DashboardController::class,'pengaturan'])->name('pengaturan');
Route::get('/upgrade', [UpgradeController::class,'index'])->name('upgrade');
Route::post('/upgrade/tabungan', [UpgradeController::class,'tabungan'])->name('tabungan.verif');
Route::post('/upgrade/ktp', [UpgradeController::class,'ktp'])->name('ktp.verif');
Route::post('/pengaturan/change_avatar',[DashboardController::class, 'change_avatar'])->name('change_avatar');
Route::post('/pengaturan/change_password',[DashboardController::class, 'change_password'])->name('change_password');
Route::post('/pengaturan/change_profile', [DashboardController::class,'change_profile'])->name('change_profile');

Route::get('/chat', [DashboardController::class, 'chat'])->name('chat');
Route::get('/chat/{user}',[ChatController::class, 'index'])->name('chat.detail');
Route::post('/chat/{user}',[ChatController::class, 'create'])->name('chat.create');

Route::get('/galeri', [DashboardController::class, 'galeri'])->name('galeri');
Route::post('/galeri/addImage', [DashboardController::class,'addImage'])->name('galeri.addImage');


//User
Route::get('/pembelian', [DashboardController::class, 'pembelian'])->name('pembelian');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/category/{category}', [CategoryController::class,'index'])->name('categories');
Route::post('/item/{id}/review/store',[ReviewController::class,'store'])->name('review.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('kategori', AdminCategoryController::class);
    Route::resource('subcategory', AdminSubcategoryController::class);
});
