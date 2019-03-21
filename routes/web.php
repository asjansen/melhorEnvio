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

Route::get('/', 'MainController@index');

Route::group(['prefix' => 'calculator'], function() {
    Route::get('/', 'CalculatorController@index')->name('calculator');
    Route::post('/result', 'CalculatorController@result')->name('result');
    Route::get('/teste', 'CalculatorController@teste')->name('teste');
});

