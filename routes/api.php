<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Api\V1\AccountController;
//use App\Http\Controllers\Api\V1\TransactionController;

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

Route ::middleware('auth:sanctum') -> get('/user', function (Request $request) {
    return $request -> user();
});

Route ::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware'=>'auth:sanctum'], function () {

    //Route all lists
    Route ::get('accounts', ['uses' => 'AccountController@index']);
    Route ::get('transactions', ['uses' => 'TransactionController@index']);

    //Route individual actions
    Route ::apiResource('account', AccountController::class);
    Route ::apiResource('transaction', TransactionController::class);

    //Route bulk additions
    Route ::post('transactions/bulk', ['uses' => 'TransactionController@bulkStore']);
});
