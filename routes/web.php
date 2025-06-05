<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home'); // Home page

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route::get('products', [ProductController::class, 'index']);
// Route::get('products/create', [ProductController::class, 'create']);

Route::get('/ai-insights', function () {
    return view('dashboard.powerbi');
})->name('dashboard.powerbi');


// Show the form to create a new diagnosis
Route::get('/diagnosis/create', [DiagnosisController::class, 'create'])->name('diagnosis.create');

// Store a new diagnosis 
Route::post('/diagnosis', [DiagnosisController::class, 'store'])->name('diagnosis.store');

// List all diagnoses (if needed, for viewing purposes)
Route::get('/diagnosis', [DiagnosisController::class, 'index'])->name('diagnosis.index');
Route::get('/diagnosis/{id}/edit', [DiagnosisController::class, 'edit'])->name('diagnosis.edit');
Route::put('/diagnosis/{id}', [DiagnosisController::class, 'update'])->name('diagnosis.update');
Route::delete('/diagnosis/{id}', [DiagnosisController::class, 'destroy'])->name('diagnosis.destroy');
Route::get('/support', function () {
    return view('support.index'); // This loads resources/views/support/index.blade.php
})->name('support.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('reports/file/{filename}', [ReportController::class, 'getFile'])->name('reports.file');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
// routes/web.php
Route::get('/dashboard/{userId}', [DashboardController::class, 'show'])->name('dashboard.show');
Route::post('/dashboard/upload', [DashboardController::class, 'upload'])->name('dashboard.upload');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');
Route::get('/receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');
Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');
Route::get('/receipts/{receipt}', [ReceiptController::class, 'show'])->name('receipts.show');
Route::get('/receipts/{receipt}/edit', [ReceiptController::class, 'edit'])->name('receipts.edit');
Route::put('/receipts/{receipt}', [ReceiptController::class, 'update'])->name('receipts.update');
Route::delete('/receipts/{receipt}', [ReceiptController::class, 'destroy'])->name('receipts.destroy');

