<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOrderController;

// ── PUBLIC ROUTES ─────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// ── AUTH ROUTES (manual, tanpa laravel/ui) ────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',   [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register',[RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ── CUSTOMER ROUTES ───────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/keranjang',        [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah',[CartController::class, 'add'])->name('cart.add');
    Route::patch('/keranjang/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{id}',[CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/pembayaran',  [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/pembayaran', [OrderController::class, 'store'])->name('order.store');
    Route::get('/history',     [OrderController::class, 'history'])->name('order.history');
    Route::get('/history/{id}',[OrderController::class, 'show'])->name('order.show');
});

// ── ADMIN ROUTES ──────────────────────────────────────────
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('produk',   AdminProductController::class);
    Route::resource('artikel',  AdminArticleController::class);
    Route::resource('pengguna', AdminUserController::class);

    Route::get('transaksi',              [AdminOrderController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{id}',         [AdminOrderController::class, 'show'])->name('transaksi.show');
    Route::patch('transaksi/{id}/status',[AdminOrderController::class, 'updateStatus'])->name('transaksi.updateStatus');
});