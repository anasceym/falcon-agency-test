<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'admin'], function() {
	
	Route::get('books', [
		'as' => 'admin.books.index',
		'uses' => 'BooksController@index'
	]);
	
	Route::post('books', [
		'as' => 'admin.books.create',
		'uses' => 'BooksController@handleCreate'
	]);
	
	Route::get('books/new', [
		'as' => 'admin.books.new',
		'uses' => 'BooksController@create'
	]);
	
	Route::get('books/{book}/edit', [
		'as' => 'admin.books.edit',
		'uses' => 'BooksController@edit'
	]);
	
	Route::get('books/{book}', [
		'as' => 'admin.books.show',
		'uses' => 'BooksController@show'
	]);
	
	Route::delete('books/{book}', [
		'as' => 'admin.books.delete',
		'uses' => 'BooksController@destroy'
	]);
	
	Route::patch('books/{book}', [
		'as' => 'admin.books.update',
		'uses' => 'BooksController@update'
	]);
	
});

Route::get('books', [
	'as' => 'books.index',
	'uses' => 'BooksController@index'
]);


Route::auth();

Route::get('/', [
	'as' => 'index',
	'uses' => 'HomeController@index'
]);
