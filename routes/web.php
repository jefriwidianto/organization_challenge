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
    return view('/auth/login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

# routes /organization
Route::group(['prefix' => 'organization'], function () {
	Route::get('/', 'OrganizationController@index')->name('organization');
	Route::get('/display_data', 'OrganizationController@display_data')->name('organization/display_data');
	Route::get('/create_organization', 'OrganizationController@create')->name('create_organization');
	Route::get('/update_organization/{id}', 'OrganizationController@update')->name('update_organization');
	Route::get('/delete_organization/{id}', 'OrganizationController@delete')->name('delete_organization');
	Route::get('/view_organization/{id}', 'OrganizationController@view')->name('view_organization');
	Route::post('/action_create', 'OrganizationController@action_create')->name('action_create');
	Route::put('/action_update/{id}', 'OrganizationController@action_update')->name('action_update');

});

# routes /person
Route::group(['prefix' => 'person'], function () {
	Route::get('/', 'PersonController@index')->name('person');
	Route::get('/display_data', 'PersonController@display_data')->name('person/display_data');
	Route::get('/create_person', 'PersonController@create')->name('create_person');
	Route::get('/update_person/{id}', 'PersonController@update')->name('update_person');
	Route::get('/delete_person/{id}', 'PersonController@delete')->name('delete_person');
	Route::get('/view_person/{id}', 'PersonController@view')->name('view_person');
	Route::post('/action_create', 'PersonController@action_create')->name('action_create');
	Route::put('/action_update/{id}', 'PersonController@action_update')->name('action_update');
});