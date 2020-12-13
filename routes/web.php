<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

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
    return redirect()->route('login');

});

// Route::get('/test',function(){
//     return 'Hello World';
// });
// Route::get('/test_2',function(){
//     return view ('test',['message'=>'Hello Wolrd']);
// });
Route::get('login','LoginController@login')->name('login');


Route::post('login/process', 'LoginController@authenticate')->name('login.authenticate');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', 'DashboardController@index')->name('admin');
    Route::get('/admin/category/create', 'CategoryController@create'); //menampilkan form create
    Route::post('/admin/category', 'CategoryController@store'); //save data
    Route::get('/admin/category', 'CategoryController@index'); // menampilkan semua data

    Route::get('/admin/category/{id}', 'CategoryController@show'); //show data
    Route::get('/admin/category/{id}/edit', 'CategoryController@edit'); //edit data
    Route::put('/admin/category/{id}', 'CategoryController@update'); //save update data
    Route::delete('/admin/category/{id}', 'CategoryController@destroy'); //delete data

    Route::resource('/admin/products', 'ProductController'); //route product

    route::get('/admin/transactions/create', 'TransactionsController@create');
    Route::post('/admin/transactions/import', 'TransactionsController@import')->name('transacstion.import');
    Route::get('/admin/transactions', 'TransactionsController@index');

    Route::get('logout','LoginController@logout')->name('logout');
});


