<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GuaranteeSectionController;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\MediaProofSectionController;
use App\Http\Controllers\Api\MentorTrustSectionController;
use App\Http\Controllers\Api\PaymentProofController;
use App\Http\Controllers\Api\ScholarshipSolutionSectionController;
use App\Http\Controllers\Api\StrategyRibbonSectionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/content/hero', [HeroSectionController::class, 'show']);
Route::get('/content/scholarship-solution', [ScholarshipSolutionSectionController::class, 'show']);
Route::get('/content/strategy-ribbon', [StrategyRibbonSectionController::class, 'show']);
Route::get('/content/mentor-trust', [MentorTrustSectionController::class, 'show']);
Route::get('/content/guarantee', [GuaranteeSectionController::class, 'show']);
Route::get('/content/media-proof', [MediaProofSectionController::class, 'show']);
Route::post('/payment-proofs', [PaymentProofController::class, 'store']);
