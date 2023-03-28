<?php

use Illuminate\Support\Facades\Route;

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

Route::group([], function () {
    Route::any('draw', 'LotteryController@draw');//抽奖
    Route::any('sqlWay', 'LotteryController@sqlWay');
    Route::any('sqlWay1', 'LotteryController@sqlWay1');
});
