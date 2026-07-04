<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentProofController;
use App\Http\Controllers\Admin\SizeController;

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


//ADMIN DASHBOARD 

// Route::get('admin/dashboard', [DashboardController::class, 'index']);
  Route::get('admin/dashboard',[DashboardController::class, 'index']);

  //=======SIZE=============

  Route::get('admin/size/index',[SizeController::class,'index'])->name('size.index');
  Route::get('admin/size/create',[SizeController::class,'create'])->name('size.create');
  Route::post('admin/size/store',[SizeController::class,'store'])->name('size.store');
  Route::get('admin/size/edit/{id}',[SizeController::class,'edit'])->name('size.edit');
  Route::post('admin/size/update',[SizeController::class,'update'])->name('size.update');
  Route::get('admin/size/destroy/{id}',[SizeController::class,'destroy'])->name('size.destroy');

  Route::get('admin/payment-proofs/index',[PaymentProofController::class,'index'])->name('payment-proofs.index');
  Route::get('admin/payment-proofs/show/{id}',[PaymentProofController::class,'show'])->name('payment-proofs.show');
  Route::get('admin/payment-proofs/edit/{id}',[PaymentProofController::class,'edit'])->name('payment-proofs.edit');
  Route::post('admin/payment-proofs/update',[PaymentProofController::class,'update'])->name('payment-proofs.update');
  Route::get('admin/payment-proofs/download/{id}',[PaymentProofController::class,'download'])->name('payment-proofs.download');
  Route::get('admin/payment-proofs/slip/{id}',[PaymentProofController::class,'slip'])->name('payment-proofs.slip');
  Route::get('admin/payment-proofs/destroy/{id}',[PaymentProofController::class,'destroy'])->name('payment-proofs.destroy');
