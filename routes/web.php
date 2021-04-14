<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
// Route::get('/', [ProductController::class, 'index']);
Route::get('/', [ProductController::class, 'index']);
Route::get('index', [ProductController::class, 'index']);

Route::post('file-import', [ProductController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [ProductController::class, 'fileExport'])->name('file-export');
Route::get('/products/{p_code}/{qty}', [ProductController::class, 'show'])->name('show');
Route::get('/carts', [ProductController::class, 'carts'])->name('carts');

Route::get('/carts/del', [ProductController::class, 'cartdel'])->name('carts.cartdel');
//Route::get('/carts/change', [ProductController::class, 'cartchange'])->name('carts.cartchange');
Route::get('/carts/update', [ProductController::class, 'cartupdate'])->name('carts.cartupdate');

Route::get('/carts/add', [ProductController::class, 'cartadd'])->name('carts.cartadd');

// Route::get('/', function () {
//     return view('index');
// });

Route::resource('products', ProductController::class);

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/admin/clear', [ProductController::class, 'clear'])->name('clear');