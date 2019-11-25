<?php

use Illuminate\Http\Request;

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



Route::prefix('/faker')->group(function () {
    Route::post('/register', function () {return response()->json(['msg'=>'歡迎光臨,這是假註冊畫面，註冊完成有 5000元獎金','name'=>'Kero','account'=>'Keroro','balance'=>5000]);});
    Route::post('/login', function () {return response()->json(['msg'=>'歡迎光臨,這是假登入畫面','name'=>'kero','balance'=>5000,'api_token'=>'xsdfwr242']);});

    Route::post('/wolf/login', function () {return response()->json(['msg'=>'假放羊孩子管理者的登入畫面','camp_name'=>'Arcadia','name'=>'wolf','api_token'=>'poiuyq991']);});
    Route::post('/wolf/items', function () {return response()->json(['msg'=>'歡迎光臨，假新增商品','id'=>1,'sort_id'=>2,'sort_name'=>'食物','item_name'=>'高粱酒','price'=>600,'pic'=>'https://www.post.gov.tw/post/FileCenter/post_ww2/Agent_Product/Ap_Img2/product_1795m_.jpg']);});
    Route::put('/items/wolf/{id}', function () {return response()->json(['msg'=>'假修改商品，已修改','id'=>1,'sort_id'=>2,'sort_name'=>'食物','item_name'=>'龍舌蘭']);});
    Route::delete('/items/wolf/{id}', function () {return response()->json(['msg'=>'假刪除商品,已刪除選擇商品']);});
    Route::get('/items', function () {return response()->json(['msg'=>'歡迎光臨，假瀏覽商品','id'=>1,'sort_id'=>2,'sort_name'=>'食物','item_name'=>'高粱酒']);});
    Route::get('/items/{sort_id}', function () {return response()->json(['msg'=>'歡迎光臨，假瀏覽分類商品','id'=>1,'sort_id'=>2,'sort_name'=>'食物','item_name'=>'高粱酒']);});
});





Route::post('/wolf/login','WolfController@login');

Route::group(['middleware' => ['auth:wolf']], function() {
    Route::post('/wolf/items', 'ItemController@store');
    Route::put('/items/wolf/{id}', 'ItemController@update');
    Route::delete('/items/wolf/{id}', 'ItemController@destory');
});


Route::get('/items','ItemController@index');
Route::get('/items/{sort_id}','ItemController@show');