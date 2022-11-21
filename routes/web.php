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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin-views.pages.auth.login'); 
});
Route::get('/admin/welcome', function () {
    return view('admin-views.welcome'); 
});

Route::get('/test', function () {
    return view('admin-views.pages.test-only.test1');

});

Route::get('/test2', function () {
    return view('admin-views.pages.test-only.test2');

});


Route::prefix('admin')->group(function () {


     // Đăng nhập và xử lý đăng nhập
     Route::get('login', [ 'as' => 'admin.auth.index', 'uses' => 'App\Http\Controllers\Admin\AuthController@index']);
     Route::post('login', [ 'as' => 'admin.auth.login', 'uses' => 'App\Http\Controllers\Admin\AuthController@login']);
    //  Route::get('login2',  function(){
    //     return "AAAA";
    // })-> name('test.trung');
     // Đăng xuất
     Route::get('logout', [ 'as' => 'admin.auth.logout', 'uses' => 'App\Http\Controllers\Admin\AuthController@logout']);
    //Category
    Route::prefix('categories')->middleware('permission:crud_manager')->group(function () {
        Route::get('/',[
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@index']);
        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@create']);
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@store']);
        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@edit']);
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@delete']);
        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\Admin\CategoryController@update']);
    });
    Route::prefix('employees')->middleware('permission:crud_manager')->group(function () {
        Route::get('/',[
            'as' => 'employees.index',
            'uses' => 'App\Http\Controllers\Admin\UserController@empIndex']);
        Route::get('/create',[
            'as' => 'employees.create',
            'uses' => 'App\Http\Controllers\Admin\UserController@empCreate']);
        Route::post('/store',[
            'as' => 'employees.store',
            'uses' => 'App\Http\Controllers\Admin\UserController@empStore']);
        Route::get('/edit/{id}',[
            'as' => 'employees.edit',
            'uses' => 'App\Http\Controllers\Admin\UserController@empEdit']);
        Route::get('/delete/{id}',[
            'as' => 'employees.delete',
            'uses' => 'App\Http\Controllers\Admin\UserController@empDelete']);
        Route::post('/update/{id}',[
            'as' => 'employees.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@empUpdate']);
    });

    Route::prefix('artists')->middleware('permission:manager')->group(function () {
        Route::get('/',[
            'as' => 'artists.index',
            'uses' => 'App\Http\Controllers\Admin\UserController@artistIndex']);
        Route::get('/create',[
            'as' => 'artists.create',
            'uses' => 'App\Http\Controllers\Admin\UserController@artistCreate']);
        Route::post('/store',[
            'as' => 'artists.store',
            'uses' => 'App\Http\Controllers\Admin\UserController@artistStore']);
        Route::get('/edit/{id}',[
            'as' => 'artists.edit',
            'uses' => 'App\Http\Controllers\Admin\UserController@artistEdit']);
        Route::get('/delete/{id}',[
            'as' => 'artists.delete',
            'uses' => 'App\Http\Controllers\Admin\UserController@artistDelete']);
        Route::post('/update/{id}',[
            'as' => 'artists.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@artistUpdate']);
    });
    Route::prefix('customers')->middleware('permission:manager')->group(function () {
        Route::get('/',[
            'as' => 'customers.index',
            'uses' => 'App\Http\Controllers\Admin\UserController@customerIndex']);
        Route::get('/create',[
            'as' => 'customers.create',
            'uses' => 'App\Http\Controllers\Admin\UserController@customerCreate']);
        Route::post('/store',[
            'as' => 'customers.store',
            'uses' => 'App\Http\Controllers\Admin\UserController@customerStore']);
        Route::get('/edit/{id}',[
            'as' => 'customers.edit',
            'uses' => 'App\Http\Controllers\Admin\UserController@customerEdit']);
        Route::get('/delete/{id}',[
            'as' => 'customers.delete',
            'uses' => 'App\Http\Controllers\Admin\UserController@customerDelete']);
        Route::post('/update/{id}',[
            'as' => 'customers.update',
            'uses' => 'App\Http\Controllers\Admin\UserController@customerUpdate']);
    });

     //Albums
     Route::prefix('albums')->middleware('permission:manager')->group(function () {
        Route::get('/',[
            'as' => 'albums.index',
            'uses' => 'App\Http\Controllers\Admin\AlbumController@index']);
        Route::get('/create',[
            'as' => 'albums.create',
            'uses' => 'App\Http\Controllers\Admin\AlbumController@create']);
        Route::post('/store',[
            'as' => 'albums.store',
            'uses' => 'App\Http\Controllers\Admin\AlbumController@store']);
        Route::get('/edit/{id}',[
            'as' => 'albums.edit',
            'uses' => 'App\Http\Controllers\Admin\AlbumController@edit']);
        Route::get('/delete/{id}',[
            'as' => 'albums.delete',
            'uses' => 'App\Http\Controllers\Admin\AlbumController@delete']);
        Route::post('/update/{id}',[
            'as' => 'albums.update',
            'uses' => 'App\Http\Controllers\Admin\AlbumController@update']);
    });
});