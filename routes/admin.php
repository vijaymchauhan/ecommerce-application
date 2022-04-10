<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        Route::get('/settings', 'App\Http\Controllers\Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'App\Http\Controllers\Admin\SettingController@update')->name('admin.settings.update');

    });

    Route::group(['prefix' => 'brands'], function () {

        Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
        Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
        Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
        Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
        Route::post('/update', 'Admin\BrandController@update')->name('admin.brands.update');
        Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');

    });

});
