<?php
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Level;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return '<center><h1>Holla!</h1>
//             <p>I am Nur Halimah and you can call me Nurha
//             <p>My student number is L200210194</p>
//             <p>My study case is about Sistem Informasi Penjualan Kue pada Toko Kue Kudapannya</p>
//             </center>';
// });

//ROUTE HOMEPAGE
Route::get('/homepage', [HomePageController::class, 'index']);

//ROUTE ABOUT US
Route::get('/about-us', [HomePageController::class, 'aboutus']);

//ROUTE PROFILE
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/signin', [ProfileController::class, 'signin']);
Route::get('/signin', [ProfileController::class, 'signin']);
Route::post('/signup', [ProfileController::class, 'signup']);
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

//ROUTE PRODUCT
Route::get('/product', [ProductController::class, 'index']);
Route::get('/search', [ProductController::class, 'search']);

//ROUTE CART
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/addcart/{id_product}', [ProductController::class, 'addcart']);
Route::delete('/removecart/{nama_product}', [ProductController::class, 'removecart'])->name('removecart');

//ROUTE CHECKOUT
Route::post('/checkout', [CheckOutController::class, 'index']);
Route::get('/checkout', [CheckOutController::class, 'index']);
Route::post('/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// ROUTE PERMISSION
Route::get('/admin', [HomePageController::class, 'indexadmin'])->middleware(Level::class . ':admin');
Route::get('/homepage', [HomePageController::class, 'index'])->middleware(Level::class . ':user');

//ROUTE ADMIN
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::delete('/user/{user}', [UserController::class, 'destroy']);
Route::get('/productadmin', [ProductController::class, 'productadmin']);
Route::delete('/productadmin/{product}', [ProductController::class, 'destroy']);
Route::get('/productadmin/edit/{id}', [ProductController::class, 'edit'])->name('productadmin.edit');
Route::get('productadmin/add', [ProductController::class, 'add']);
Route::post('/add_process', [ProductController::class, 'add_process'])->name('add_process');
Route::put('/productadmin/update/{id}', [ProductController::class, 'update'])->name('productadmin.update');