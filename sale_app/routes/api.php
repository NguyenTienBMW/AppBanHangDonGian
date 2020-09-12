<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get_sanpham','MyController@getsanpham');
Route::get('get_loaisanpham','MyController@getloaisanpham');

Route::post('get_laptop','MyController@getlaptop');
Route::post('get_thongtin','MyController@getthongtin');
Route::post('dangki','MyController@register');
Route::post('dangnhap','MyController@login');
Route::post('donhang','MyController@donhang');
Route::post('search','MyController@search');
Route::post('thongtinkh','MyController@thongtinkhachhang');
 