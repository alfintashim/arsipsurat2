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

Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('user', 'UserController');
    Route::put('user/{id}/role', 'UserController@update_role');

    Route::resource('role', 'RoleController');

    Route::resource('tsm', 'SuratMasukController');
    Route::get('tsm/{id}/file', 'SuratMasukController@file')->name('tsm.file');

    Route::resource('tsk', 'SuratKeluarController');
    Route::get('tsk/{id}/file', 'SuratKeluarController@file')->name('tsk.file');

    Route::prefix('/lsm')->name('lsm.')->group(function() {
        Route::get('/', 'LaporanController@index_lsm')->name('index');
        Route::get('/download', 'LaporanController@download_lsm')->name('download');
    });

    Route::prefix('/lsk')->name('lsk.')->group(function() {
        Route::get('/', 'LaporanController@index_lsk')->name('index');
        Route::get('/download', 'LaporanController@download_lsk')->name('download');
    });

    Route::resource('profil', 'InstansiController');

    Route::resource('kns', 'KodeNomorSuratController');

    Route::get('password', 'PasswordController@change')->name('password.change');
    Route::put('password', 'PasswordController@update')->name('password.update');
});