<?php
use App\Http\Middleware\HelloMiddleware;
Route::get('/', 'BookController@index');
Route::get('book', 'BookController@index');
Route::get('book/create', 'BookController@create');
Route::post('book/create', 'BookController@store');
Route::get('book/detail/{id}', 'BookController@detail');
Route::post('book/update', 'BookController@update');
Route::get('book/rate', 'BookController@rate');
Route::get('book/regist', 'BookController@regist');
Route::get('book/category/{id}', 'BookController@category');
// Route::get('book/category/rate/{id}', 'BookController@regist');
Route::get('book/slide', 'BookController@slide');
// Route::get('book/create', 'CategoryController@index');