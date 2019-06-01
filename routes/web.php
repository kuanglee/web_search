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

Route::get('logout' , function (){
    Auth::logout();
    return redirect('/login');
});



//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function() {

    Route::group(['prefix'=>'dictionary'],function(){
        Route::get('add' , 'DictionaryController@getView');

        Route::post('add','DictionaryController@postAddDictionary')->name('admin.dictionary.add');

        Route::get('list' , 'DictionaryController@getViewDictionary')->name('list');

        Route::get('edit/{id}' , 'DictionaryController@getEditDictionary');

        Route::post('edit/{id}' , 'DictionaryController@postEditDictionary')->name('admin.dictionary.edit');

        Route::get('delete/{id}' ,'DictionaryController@deleteDictionary');

        Route::get('search' , 'DictionaryController@getViewSearchDictionary');

        Route::get('ResultDictionary/{id}/{key}' ,'DictionaryController@getResultSearch');

        Route::post('/autocomplete/fetch', 'DictionaryController@fetch')->name('autocomplete.fetch');

        Route::post('/auto/select', 'DictionaryController@select')->name('auto.select');
    });



    Route::get('home' , function (){
       return view('admin.home');
    });
});
