<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShortcodeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pages', PageController::class);

Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

Route::get('/{slug}', 'App\Http\Controllers\SlugController@showBySlug')->name('pages.showBySlug');


// Route for handling shortcodes
Route::get('/{shortcode}', [ShortcodeController::class, 'handleShortcode'])->name('shortcode.handle');

Route::get('/get-shortcode-config/{shortcodeType}', function ($shortcodeType) {
    // Render the Blade view corresponding to the selected shortcode type
    return view($shortcodeType);
});