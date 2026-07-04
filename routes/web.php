<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentProofController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AccountSettingsController;
use App\Http\Controllers\Admin\EmployeeController;

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

// Redirect root to login page or dashboard
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'owner') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('payment-proofs.index');
    }
    return redirect()->route('login');
});

// Redirect /home to dashboard based on role
Route::get('/home', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'owner') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('payment-proofs.index');
    }
    return redirect()->route('login');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.perform');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Protected Admin Workspace
Route::middleware('auth')->prefix('admin')->group(function () {

    // === Owner-Only Administration Control ===
    Route::middleware('role:owner')->group(function () {
        
        // Account Settings Profile Configuration
        Route::get('settings', [AccountSettingsController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [AccountSettingsController::class, 'update'])->name('settings.update');

        // Dynamic Employee Management CRUD
        Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('employees/store', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::post('employees/update', [EmployeeController::class, 'update'])->name('employees.update');
        Route::get('employees/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    // === Permission-Guarded Application Modules ===
    
    // 1. Dashboard Access
    Route::middleware('permission:dashboard')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

    // 2. Size Parameters CRUD
    Route::middleware('permission:sizes')->group(function () {
        Route::get('size/index', [SizeController::class, 'index'])->name('size.index');
        Route::get('size/create', [SizeController::class, 'create'])->name('size.create');
        Route::post('size/store', [SizeController::class, 'store'])->name('size.store');
        Route::get('size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
        Route::post('size/update', [SizeController::class, 'update'])->name('size.update');
        Route::get('size/destroy/{id}', [SizeController::class, 'destroy'])->name('size.destroy');
    });

    // 3. Payment Proofs Access
    Route::middleware('permission:proofs')->group(function () {
        Route::get('payment-proofs/index', [PaymentProofController::class, 'index'])->name('payment-proofs.index');
        Route::get('payment-proofs/show/{id}', [PaymentProofController::class, 'show'])->name('payment-proofs.show');
        Route::get('payment-proofs/edit/{id}', [PaymentProofController::class, 'edit'])->name('payment-proofs.edit');
        Route::post('payment-proofs/update', [PaymentProofController::class, 'update'])->name('payment-proofs.update');
        Route::get('payment-proofs/download/{id}', [PaymentProofController::class, 'download'])->name('payment-proofs.download');
        Route::get('payment-proofs/slip/{id}', [PaymentProofController::class, 'slip'])->name('payment-proofs.slip');
        Route::get('payment-proofs/destroy/{id}', [PaymentProofController::class, 'destroy'])->name('payment-proofs.destroy');
    });

});
