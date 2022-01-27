<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Users;
use App\Http\Controllers\API\Loans;
use App\Http\Controllers\API\Transactions;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[Users::class,'register']);
Route::post('/login',[Users::class,'login']);
Route::get('/unauthenticated',[Users::class,'unauthenticated'])->name('unauthenticated');

Route::middleware('auth:api')->group(function () {
    Route::post('/createLoan',[Loans::class,'create']);
    Route::post('/getLoans',[Loans::class,'getLoans']);
    Route::post('/loanDetails/{id}',[Loans::class,'loanDetails']);
    Route::post('/createInstallment',[Transactions::class,'createInstallment']);
});
