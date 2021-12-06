<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    ResellerController,
    SearchController,
    PayoutController
};
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    ItemController as AdminItemController,
    CategoryController as AdminCategoryController,
    SubcategoryController as AdminSubcategoryController,
    UserController as AdminUserController,
    PembelianController as AdminPembelianController,
    ChatController as AdminChatController,
    PengaturanWebsiteController as AdminPengaturanWebsiteController,
    FeaturesController as AdminFeaturesController
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
Route::post('/search', [WelcomeController::class,'search'])->name('welcome.search');
Route::get('/search/{keyword}', [SearchController::class,'index'])->name('search');
Route::get('/penjual/{seller}/item/{product}',[ProductController::class,'index'])->name('item.detail');
Route::get('/penjual/{seller}', [VendorController::class,'index'])->name('vendor');

//Auth
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
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
Route::middleware('auth')->group(function(){
    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('welcome');
    })->name('logout');
    
    Route::get('/pengaturan', [DashboardController::class,'pengaturan'])->name('pengaturan');
    Route::get('/upgrade', [UpgradeController::class,'index'])->name('upgrade');
    Route::post('/upgrade/add', [UpgradeController::class,'upgrade'])->name('upgrade.add');
    Route::post('/pengaturan/change_avatar',[DashboardController::class, 'change_avatar'])->name('change_avatar');
    Route::post('/pengaturan/change_password',[DashboardController::class, 'change_password'])->name('change_password');
    Route::post('/pengaturan/change_profile', [DashboardController::class,'change_profile'])->name('change_profile');

    Route::get('/chat', [DashboardController::class, 'chat'])->name('chat');
    Route::get('/chat/{user}',[ChatController::class, 'index'])->name('chat.detail');
    Route::post('/chat/{user}',[ChatController::class, 'create'])->name('chat.create');

    Route::get('/galeri', [DashboardController::class, 'galeri'])->name('galeri');
    Route::post('/galeri/addImage', [DashboardController::class,'addImage'])->name('galeri.addImage');
    Route::get('/pembelian', [DashboardController::class, 'pembelian'])->name('pembelian');

    //Reseller
    Route::middleware('reseller')->name('reseller.')->group(function () {
        Route::get('/penjualan', [ResellerController::class, 'penjualan'])->name('penjualan');
        Route::get('/payout', [PayoutController::class, 'index'])->name('payout'); 
        Route::post('/payout', [PayoutController::class, 'create'])->name('payout'); 
        Route::get('/product', [ResellerController::class, 'product'])->name('product');
        Route::post('/product', [ResellerController::class,'product'])->name('product');
        Route::get('/product/{item}/edit',[ResellerController::class,'edit'])->name('product.edit');
        Route::delete('/product/{item}/delete', [ResellerController::class, 'destroy'])->name('product.delete');
        Route::get('/product/add', [ResellerController::class, 'new_product'])->name('product.add');
        Route::post('/product/add', [ResellerController::class, 'store_product'])->name('product.store');
        Route::put('/product/{item}/update', [ResellerController::class,'update'])->name('product.update');
    });
    Route::get('/product/{category}/subcategory/ajax',[ResellerController::class,'ajax_subcategory'])->name('ajax.product.subcategory');
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('kategori', AdminCategoryController::class);
        Route::resource('subcategory', AdminSubcategoryController::class);
        Route::get('/user/verified', [AdminUserController::class, 'verified'])->name('user.verified');
        Route::post('/user/verified/{user}/add', [AdminUserController::class, 'verified_add'])->name('user.verified.add');
        Route::post('/user/verified/{user}/declined', [AdminUserController::class, 'verified_declined'])->name('user.verified.declined');
        Route::resource('user', AdminUserController::class);
        Route::resource('pembelian', AdminPembelianController::class);
        Route::resource('item', AdminItemController::class);
        Route::resource('chat', AdminChatController::class);
        Route::resource('pengaturan', AdminPengaturanWebsiteController::class);
        Route::resource('features', AdminFeaturesController::class);
    });

});
//User
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'checkout'])->name('checkout');
Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/item/{id}/review/store',[ReviewController::class,'store'])->name('review.store');
Route::get('/category/{cat}/subcategory/{subcat}',[CategoryController::class,'indexSubcategory'])->name('category.subcategory');
Route::post('/category/{category}/subcategory',[CategoryController::class,'subcategories'])->name('category.subcategory');
