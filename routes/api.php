<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChooseController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/user/info', [AuthController::class, 'getUserInfo'])->middleware('auth:sanctum')->name('getUserInfo');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/all', [UserController::class, 'getAllUser'])->name('getAllUser');
    Route::post('/user/add', [UserController::class, 'addUser'])->name('addUser');
    Route::put('/user/edit', [UserController::class, 'editUser'])->name('editUser');
    Route::delete('/user/delete', [UserController::class, 'deleteUser'])->name('deleteUser');
    
    Route::get('/kategori/menu/all', [MenuCategoryController::class, 'getAllKategoriM'])->name('getAllKategoriM');
    Route::post('/kategori/menu/add', [MenuCategoryController::class, 'addKategoriM'])->name('addKategoriM');
    Route::put('/kategori/menu/edit', [MenuCategoryController::class, 'editKategoriM'])->name('editKategoriM');
    Route::delete('/kategori/menu/delete', [MenuCategoryController::class, 'deleteKategoriM'])->name('deleteKategoriM');

    Route::get('/shop/byUser', [ShopController::class, 'getShopByUserId'])->name('getShopByUserId');
    Route::post('/shop/add', [ShopController::class, 'addShop'])->name('addShop');
    Route::put('/shop/add/image', [ShopController::class, 'addShopImage'])->name('addShopImage');
    Route::put('/shop/edit', [ShopController::class, 'editShop'])->name('editShop');
    Route::delete('/shop/delete', [ShopController::class, 'deleteShop'])->name('deleteShop');

    Route::get('/discount/all', [DiscountController::class, 'getAllDiscount'])->name('getAllDiscount');
    Route::post('/discount/add', [DiscountController::class, 'addDiscount'])->name('addDiscount');
    Route::put('/discount/edit', [DiscountController::class, 'editDiscount'])->name('editDiscount');
    Route::delete('/discount/delete', [DiscountController::class, 'deleteDiscount'])->name('deleteDiscount');

    Route::get('/menu/all/paid/byShop', [MenuController::class, 'getAllPaidedMenuByShop'])->name('getAllPaidedMenuByShop');
    Route::get('/menu/all/paid/byInvoice', [MenuController::class, 'getAllPaidedMenuByInvoice'])->name('getAllPaidedMenuByInvoice');
    Route::post('/menu/done/paid/byShop', [MenuController::class, 'donePaidedMenuByShop'])->name('donePaidedMenuByShop');
    Route::post('/menu/add', [MenuController::class, 'addMenu'])->name('addMenu');
    Route::put('/menu/add/image', [MenuController::class, 'addMenuImage'])->name('addMenuImage');
    Route::put('/menu/edit', [MenuController::class, 'editMenu'])->name('editMenu');
    Route::delete('/menu/delete', [MenuController::class, 'deleteMenu'])->name('deleteMenu');

    Route::get('/menu/detail/category/{menuId}', [ChooseController::class, 'getAllMenuCategoryByMenuId'])->name('getAllMenuCategoryByMenuId');
    Route::post('/menu/detail/category/add', [ChooseController::class, 'addMenuCategoryByMenuId'])->name('addMenuCategoryByMenuId');
    Route::delete('/menu/detail/category/delete', [ChooseController::class, 'deleteMenuCategoryByMenuId'])->name('deleteMenuCategoryByMenuId');

    Route::get('/booking/byUser', [BookingController::class, 'getBookingByUserId'])->name('getBookingByUserId');
    Route::get('/booking/prog/byUser', [BookingController::class, 'getOneBookingIdByUserId'])->name('getOneBookingIdByUserId');
    Route::get('/booking/all', [BookingController::class, 'getAllBooking'])->name('getAllBooking');
    Route::post('/booking/add', [BookingController::class, 'addBooking'])->name('addBooking');
    Route::put('/booking/edit', [BookingController::class, 'editBooking'])->name('editBooking');
    Route::delete('/booking/delete', [BookingController::class, 'deletebooking'])->name('deletebooking');

    Route::get('/booking/detail/menu/{bookingId}', [CheckoutController::class, 'getAllMenuByBookingId'])->name('getAllMenuByBookingId');
    Route::post('/booking/detail/menu/add', [CheckoutController::class, 'addMenuByBookingId'])->name('addMenuByBookingId');
    Route::put('/booking/detail/menu/edit', [CheckoutController::class, 'editMenuByBookingId'])->name('editMenuByBookingId');
    Route::delete('/booking/detail/menu/delete', [CheckoutController::class, 'deleteMenuByBookingId'])->name('deleteMenuByBookingId');

    Route::get('/invoice/menu/ByBooking', [InvoiceController::class, 'getAllInvoiceMenuByBookingId'])->name('getAllInvoiceMenuByBookingId');
    Route::get('/invoice/all/byUser', [InvoiceController::class, 'getAllInvoiceByUserId'])->name('getAllInvoiceByUserId');
    Route::post('/invoice/add', [InvoiceController::class, 'addInvoice'])->name('addInvoice');
    Route::delete('/invoice/delete', [InvoiceController::class, 'deleteInvoice'])->name('deleteInvoice');                                   
});

Route::group(['prefix' => 'menu'], function() {
    Route::get('/byShop', [MenuController::class, 'getMenuById'])->name('getMenuById');
    Route::get('/all', [MenuController::class, 'getAllMenu'])->name('getAllMenu');
});

Route::group(['prefix' => 'shop'], function() {
    Route::get('/all', [ShopController::class, 'getAllShop'])->name('getAllShop');
});

Route::post('/token/test', function() {
    try {
        return response()->json([
            'status' => 'success',
            'message' => 'Token is valid'
        ]);
    } catch (Exception $error) {
        return response()->json([
            'status' => 'error',
            'message' => $error->getMessage()
        ]);
    }
})->middleware('auth:sanctum');

Route::any('{any}', function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Endpoint not found'
    ])->setStatusCode(404);
})->where('any', '.*');