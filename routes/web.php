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
    TopupController,
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
    PaymentCategoryController as AdminPaymentCategoryController,
    CategoryController as AdminCategoryController,
    SubcategoryController as AdminSubcategoryController,
    UserController as AdminUserController,
    PembelianController as AdminPembelianController,
    ChatController as AdminChatController,
    PayoutController as AdminPayoutController,
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
Route::get('/search', [SearchController::class,'index'])->name('welcome.search');
Route::get('/search/{keyword}', [SearchController::class,'index'])->name('search');
Route::get('/penjual/{seller}/item/{product}',[ProductController::class,'index'])->name('item.detail');
Route::get('/penjual/{seller}', [VendorController::class,'index'])->name('vendor');

//Auth
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class,'authenticate'])->name('login');
Route::post('/register', [AuthController::class,'registerUser'])->name('register');

//Setting
Route::middleware('auth')->group(function(){
    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('welcome');
    })->name('logout');

    Route::get('/pengaturan', [DashboardController::class,'pengaturan'])->name('pengaturan');
    Route::get('/verification', [DashboardController::class,'verification'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/pengaturan')->with('success','Email berhasil diverifikasi!');
    })->middleware(['auth', 'signed'])->name('verification.verify');    

    Route::get('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Link verifikasi telah dikirim!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    
    Route::get('/product/{category}/subcategory/ajax',[ResellerController::class,'ajax_subcategory'])->name('ajax.product.subcategory');
    
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/change_password', [DashboardController::class, 'indexChangePassword'])->name('index_change_password');
    Route::post('/pengaturan/change_avatar',[DashboardController::class, 'change_avatar'])->name('change_avatar');
    Route::post('/pengaturan/change_password',[DashboardController::class, 'change_password'])->name('change_password');
    Route::post('/pengaturan/change_profile', [DashboardController::class,'change_profile'])->name('change_profile');
    Route::get('/chat/{id}',[ChatController::class, 'index'])->name('chat');
    Route::get('/pembayaran', [DashboardController::class, 'pembayaran'])->name('pembayaran');

    Route::get('/pembelian', [DashboardController::class, 'pembelian'])->name('pembelian');
    Route::get('/topup', [TopupController::class, 'index'])->name('topup');
    Route::get('/topup/{id}', [TopupController::class, 'detail'])->name('topup.detail');
    Route::post('/topup/saldo', [TopupController::class,'topup'])->name('topup.saldo');
    Route::post('/topup/check/{id}', [TopupController::class,'check'])->name('topup.check');
    Route::post('/topup/cancel', [TopupController::class,'cancel'])->name('topup.cancel');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'checkout'])->name('checkout');
    Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    Route::get('/payment/{id}', [CartController::class, 'payment'])->name('payment');
    Route::post('/payment/{id}', [CartController::class,'purchase'])->name('purchase');
    Route::post('/payment/check/{id}',[CartController::class,'payment_check'])->name('payment.check');
    
    Route::get('/review/{id}', [ReviewController::class, 'index'])->name('review');
    Route::post('/review/{id}/add',[ReviewController::class, 'add'])->name('review.add');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('kategori', AdminCategoryController::class);
        Route::resource('kategoripembayaran', AdminPaymentCategoryController::class);
        Route::resource('subcategory', AdminSubcategoryController::class);
        Route::get('/reseller/verified', [AdminUserController::class, 'verified'])->name('reseller.verified');
        Route::post('/reseller/verified/{user}/add', [AdminUserController::class, 'verified_add'])->name('reseller.verified.add');
        Route::post('/reseller/verified/{user}/declined', [AdminUserController::class, 'verified_declined'])->name('reseller.verified.declined');
        Route::resource('user', AdminUserController::class);
        Route::resource('pembelian', AdminPembelianController::class);
        Route::resource('item', AdminItemController::class);
        Route::resource('chat', AdminChatController::class);
        Route::resource('pengaturan', AdminPengaturanWebsiteController::class);
        Route::resource('features', AdminFeaturesController::class);
        Route::get('/payout', [AdminPayoutController::class,'index'])->name('payout.index');
        Route::post('/payout/{id}/success', [AdminPayoutController::class, 'success'])->name('payout.success');
        Route::post('/payout/{id}/canceled', [AdminPayoutController::class, 'canceled'])->name('payout.canceled');
    });
    Route::middleware('verified')->group(function(){
        //Reseller
        Route::get('/upgrade', [UpgradeController::class,'index'])->name('upgrade');
        Route::post('/upgrade/add', [UpgradeController::class,'upgrade'])->name('upgrade.add');
        Route::middleware('reseller')->name('reseller.')->group(function () {
            Route::get('/penjualan', [ResellerController::class, 'penjualan'])->name('penjualan');
            Route::get('/payout', [PayoutController::class, 'index'])->name('payout'); 
            Route::get('/payout/add', [PayoutController::class, 'show'])->name('payout.show'); 
            Route::post('/payout/create', [PayoutController::class, 'create'])->name('payout.create'); 
            Route::get('/product', [ResellerController::class, 'product'])->name('product');
            Route::post('/product', [ResellerController::class,'product'])->name('product');
            Route::get('/product/{item}/edit',[ResellerController::class,'edit'])->name('product.edit');
            Route::delete('/product/{item}/delete', [ResellerController::class, 'destroy'])->name('product.delete');
            Route::get('/product/add', [ResellerController::class, 'new_product'])->name('product.add');
            Route::post('/product/add', [ResellerController::class, 'store_product'])->name('product.store');
            Route::post('/product/{item}/update', [ResellerController::class,'update'])->name('product.update');
            Route::post('/product/{item}/updateImage', [ResellerController::class,'updateImage'])->name('product.updateImage');
        });

        // Admin
        
    });    
});

//User
Route::post('/item/{id}/review/store',[ReviewController::class,'store'])->name('review.store');
Route::get('/category/{slug}',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/{cat}/subcategory/{subcat}',[CategoryController::class,'indexSubcategory'])->name('category.subcategory');
Route::post('/category/{category}/subcategory',[CategoryController::class,'subcategories'])->name('category.subcategory');
