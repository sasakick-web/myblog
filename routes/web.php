<?php

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

Route::get('/', 'BlogController@showList')
->name('blogs');

Route::get('/blog/create', 'BlogController@showCreate')
->name('create')->middleware('auth');

Route::post('/blog/store', 'BlogController@exeStore')
->name('store');

Route::get('/blog/{id}', 'BlogController@showDetail')
->name('show');

Route::get('/blog/edit/{id}', 'BlogController@showEdit')
->name('edit');

Route::post('/blog/update', 'BlogController@exeUpdate')
->name('update');

Route::post('/blog/delete/{id}', 'BlogController@exeDelete')
->name('delete');

// ログイン機能生成時 自動生成route
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ユーザー登録アクセス制限（ログインユーザーのみアクセス可能）
Route::get('/register', 'HomeController@index')->name('register')->middleware('auth');
