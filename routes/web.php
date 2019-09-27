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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect('admin/home');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/Switcher_Language/{locale}', 'HomeController@Switcher_Language');

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'dictionary'], function () {
        Route::get('add', 'DictionaryController@getView');
        Route::post('add', 'DictionaryController@postAddDictionary')->name('admin.dictionary.add');
        Route::get('list', 'DictionaryController@getViewDictionary')->name('list');
        Route::get('edit/{id}', 'DictionaryController@getEditDictionary');
        Route::post('edit/{id}', 'DictionaryController@postEditDictionary')->name('admin.dictionary.edit');
        Route::get('delete/{id}', 'DictionaryController@deleteDictionary');
        Route::get('search', 'DictionaryController@getViewSearchDictionary');
        Route::get('ResultDictionary/{id}/{key}', 'DictionaryController@getResultSearch');
        Route::post('/autocomplete/fetch', 'DictionaryController@fetch')->name('autocomplete.fetch');
        Route::post('/auto/select', 'DictionaryController@select')->name('auto.select');
    });

    Route::group(['prefix' => 'categorys'], function () {
        Route::get('/', ['as' => 'admin.categorys.index', 'uses' => 'CategorysController@index']);
        Route::get('/add', ['as' => 'admin.categorys.add', 'uses' => 'CategorysController@create']);
        Route::get('/show/{id}', ['as' => 'admin.categorys.show', 'uses' => 'CategorysController@show']);
        Route::post('/store', ['as' => 'admin.categorys.store', 'uses' => 'CategorysController@store']);
        Route::post('/updateAjax', ['as' => 'admin.categorys.updateAjax', 'uses' => 'CategorysController@updateAjax']);
        Route::get('/edit/{id}', ['as' => 'admin.categorys.edit', 'uses' => 'CategorysController@edit']);
        Route::patch('/update', ['as' => 'admin.categorys.update', 'uses' => 'CategorysController@update']);
        Route::delete('/destroy/{id}', ['as' => 'admin.categorys.destroy', 'uses' => 'CategorysController@destroy']);
    });

    // type new
    Route::group(['prefix' => 'typenews'], function () {
        Route::get('/', ['as' => 'admin.typenews.index', 'uses' => 'TypenewsController@index']);
        Route::get('/add', ['as' => 'admin.typenews.add', 'uses' => 'TypenewsController@create']);
        Route::get('/show/{id}', ['as' => 'admin.typenews.show', 'uses' => 'TypenewsController@show']);
        Route::post('/store', ['as' => 'admin.typenews.store', 'uses' => 'TypenewsController@store']);
        Route::post('/updateAjax', ['as' => 'admin.typenews.updateAjax', 'uses' => 'TypenewsController@updateAjax']);
        Route::get('/edit/{id}', ['as' => 'admin.typenews.edit', 'uses' => 'TypenewsController@edit']);
        Route::patch('/update', ['as' => 'admin.typenews.update', 'uses' => 'TypenewsController@update']);
        Route::delete('/destroy/{id}', ['as' => 'admin.typenews.destroy', 'uses' => 'TypenewsController@destroy']);
    });

    // loai tin
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('/', ['as' => 'admin.loaitin.index', 'uses' => 'LoaiTinController@index']);
        Route::get('/add', ['as' => 'admin.loaitin.add', 'uses' => 'LoaiTinController@create']);
        Route::get('/show/{id}', ['as' => 'admin.loaitin.show', 'uses' => 'LoaiTinController@show']);
        Route::post('/store', ['as' => 'admin.loaitin.store', 'uses' => 'LoaiTinController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.loaitin.edit', 'uses' => 'LoaiTinController@edit']);
        Route::patch('/update/{id}', ['as' => 'admin.loaitin.update', 'uses' => 'LoaiTinController@update']);
        Route::delete('/destroy/{id}', ['as' => 'admin.typenews.destroy', 'uses' => 'LoaiTinController@destroy']);
    });
    // use
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);
        Route::get('/add', ['as' => 'admin.users.add', 'uses' => 'UsersController@create']);
        Route::get('/show/{id}', ['as' => 'admin.users.show', 'uses' => 'UsersController@show']);
        Route::post('/store', ['as' => 'admin.users.store', 'uses' => 'UsersController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.users.edit', 'uses' => 'UsersController@edit']);
        Route::patch('/update/{id}', ['as' => 'admin.users.update', 'uses' => 'UsersController@update']);
        Route::delete('/destroy/{id}', ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);
    });
    Route::group(['middleware' => ['checkAcl:user-add']], function () {
        // user
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', ['as' => 'admin.roles.index', 'uses' => 'RolesController@index']);
            Route::get('/add', ['as' => 'admin.roles.add', 'uses' => 'RolesController@create']);
            Route::get('/show/{id}', ['as' => 'admin.roles.show', 'uses' => 'RolesController@show']);
            Route::post('/store', ['as' => 'admin.roles.store', 'uses' => 'RolesController@store']);
            Route::get('/edit/{id}', ['as' => 'admin.roles.edit', 'uses' => 'RolesController@edit']);
            Route::patch('/update/{id}', ['as' => 'admin.roles.update', 'uses' => 'RolesController@update']);
            Route::delete('/destroy/{id}', ['as' => 'admin.roles.destroy', 'uses' => 'RolesController@destroy']);
        });
    });
    // shops
    Route::group(['prefix' => 'shops'], function () {
        Route::get('/', ['as' => 'admin.shops.index', 'uses' => 'ShopsController@index']);
        Route::get('/add', ['as' => 'admin.shops.add', 'uses' => 'ShopsController@create']);
        Route::get('/show/{id}', ['as' => 'admin.shops.show', 'uses' => 'ShopsController@show']);
        Route::post('/store', ['as' => 'admin.shops.store', 'uses' => 'ShopsController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.shops.edit', 'uses' => 'ShopsController@edit']);
        Route::patch('/update/{id}', ['as' => 'admin.shops.update', 'uses' => 'ShopsController@update']);
        Route::delete('/destroy/{id}', ['as' => 'admin.shops.destroy', 'uses' => 'ShopsController@destroy']);
    });


    Route::get('/home', ['as' => 'admin.master.index', 'uses' => 'MasterController@index']);

});
