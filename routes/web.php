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


Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /*
     * Manage Subject
     */
    Route::get('/subjects', 'SubjectController@index')->name('subjects');
    Route::get('/subjects/create', 'SubjectController@create')->name('subjects-create');
    Route::post('/subjects/store', 'SubjectController@store')->name('subjects-store');
    Route::get('/subjects/view/{id}', 'SubjectController@view')->name('subjects-view');
    Route::get('/subjects/edit/{id}', 'SubjectController@edit')->name('subjects-edit');
    Route::post('/subjects/update', 'SubjectController@update')->name('subjects-update');
    Route::post('/subjects/delete', 'SubjectController@delete')->name('subjects-delete');

    /*
     * Manage Students
     */
    Route::get('/students', 'StudentController@index')->name('students');
    Route::get('/students/create', 'StudentController@create')->name('students-create');
    Route::post('/students/store', 'StudentController@store')->name('students-store');
    Route::get('/students/view/{id}', 'StudentController@view')->name('students-view');
    Route::get('/students/edit/{id}', 'StudentController@edit')->name('students-edit');
    Route::post('/students/update', 'StudentController@update')->name('students-update');
    Route::post('/students/delete', 'StudentController@delete')->name('students-delete');

    /*
     * Add Marks
     */
    Route::get('/marks/add', 'MarksController@add')->name('marks-add');
    Route::post('/marks/store', 'MarksController@store')->name('marks-store');

});
