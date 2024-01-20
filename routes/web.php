<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\BorrowedItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;




Route::get('image-upload', [ImageUploadController::class, 'imageUpload'])->name('image.upload');
Route::post('image-upload', [ImageUploadController::class, 'imageUploadPost'])->name('image.upload.post');
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

Route::post('/historyItem', [PostHistoryController::class, 'store'])->name('home.index');
// Route::get('/files/{filename}', 'FileController@show')->middleware('auth');

// Public Routes
Route::get('/', [ItemController::class, 'home'])->name('home.index');
Route::get('/search', [ItemController::class, 'search'])->name('home.search');
Route::get('/item-list', [ItemController::class, 'index'])->name('item.index');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');

// Admin Routes
Route::group(['middleware' => ['role:systemAdmin']], function () {
    // Borrowing and returning routes
    Route::get('/lend', [BorrowedItemController::class, 'index'])->name('item.borrowing');
    Route::post('/item/lend', [BorrowedItemController::class, 'store'])->name('item.store');
    Route::get('/return', [BorrowedItemController::class, 'returning'])->name('item.returning');
    Route::get('/item-return', [BorrowedItemController::class, 'returning'])->name('item.returning');
    Route::put('/item-return', [BorrowedItemController::class, 'updateBorrowedDetail'])->name('item.update');
    Route::get('/riwayat', [BorrowedItemController::class, 'history'])->name('item.history');

    // Item management
    Route::post('/create', [ItemController::class, 'store']);
    Route::get("/create/item", [ItemController::class, 'create']);
    Route::prefix('/item')->group(function () {
        Route::patch('/{item}/edit', [ItemController::class, 'update']);
        Route::delete('/{item}/delete', [ItemController::class, 'destroy'])->name('item.destroy');
    });
});

// Test route
Route::get('/test', [ItemController::class, 'test'])->name('item.test');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Laravel default authentication routes
require __DIR__ . '/auth.php';
