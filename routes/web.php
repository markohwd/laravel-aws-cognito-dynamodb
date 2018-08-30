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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/users', 'HomeController@getUsers')->name('users');
Route::get('/home/organizations', 'HomeController@getOrganizations')->name('organizations');


Route::get('/home/hyperusers', 'HyperUserController@getIndex')->name('hyper-users');
Route::post('/home/hyperusers/get', 'HyperUserController@get')->name('hyper-user-get');
Route::get('/home/hyperusers/new', 'HyperUserController@new')->name('hyper-user-new');
Route::post('/home/hyperusers/create', 'HyperUserController@create')->name('hyper-user-create');
Route::get('/home/hyperusers/edit', 'HyperUserController@edit')->name('hyper-user-edit');
Route::post('/home/hyperusers/update', 'HyperUserController@update')->name('hyper-user-update');
Route::get('/home/hyperusers/delete', 'HyperUserController@delete')->name('hyper-user-delete');

Route::get('/home/hyperusers/edit-password', 'HyperUserController@editPassword')->name('hyper-user-edit-password');
Route::post('/home/hyperusers/update-password', 'HyperUserController@updatePassword')->name('hyper-user-update-password');


		/* 
        | ORGANIZATION (RESTFUL)
        
        Route::resource([
        	'organization' => 'HyperUserController'

        ]);

        */
        Route::prefix('/home/hyperorganizations')->group(function () {

            Route::get('/', 'HyperOrganizationController@getIndex')->name('hyper-organizations');
            Route::post('/get', 'HyperOrganizationController@get')->name('hyper-organization-get');
            Route::get('/new', 'HyperOrganizationController@new')->name('hyper-organization-new');
            Route::post('/create', 'HyperOrganizationController@create')->name('hyper-organization-create');
            Route::get('/edit', 'HyperOrganizationController@edit')->name('hyper-organization-edit');
            Route::post('/update', 'HyperOrganizationController@update')->name('hyper-organization-update');
            Route::get('/delete', 'HyperOrganizationController@delete')->name('hyper-organization-delete');

        });


		/* 
        | USERS (RESTFUL)
        
        Route::resource('/users', 'HyperOrganizationController', [
        'names' => [

            //'index' => 'user',
            //'create' => 'user.create',
            //'store' => 'user.store',
            //'show' => 'user.show',
            'edit' => 'user.edit',
            'update' => 'user.update',
            'destroy' => 'user.destroy'
        ]

        ]);