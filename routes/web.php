<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();
Route::resource('/home', 'HomeController')->middleware('auth');
Route::resource('/Pharmacy/show', 'PharmacyController')->middleware('auth');
Route::post('pharmacy_edit/{pid}','PharmacyController@pharmacy_edit')->middleware('auth');
Route::post('update_pharmacy_password','PharmacyController@change_pharmacy_password')->middleware('auth');
Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'PharmacyController@myformAjax'));
Route::get('/Pharmacy/addNewBranch', 'PharmacyController@showAddBranch')->middleware('auth');
Route::post('/Pharmacy/addNewBranch', 'PharmacyController@addNewBranch')->middleware('auth');
Route::get('/Pharmacy/delete/{bid}/{rid}','PharmacyController@delete')->middleware('auth');
Route::get('/Pharmacy/active/{bid}','PharmacyController@activate')->middleware('auth');
Route::get('/phregister', 'Pharmacy\RegisterController@showRegistrationForm')->name('phregister');

Route::post('/phregister', 'Pharmacy\RegisterController@register');

Route::get('/phlogin','Pharmacy\LoginController@showLoginForm')->name('phlogin');;

Route::post('/phlogin','Pharmacy\LoginController@login');

Route::resource('/Medicine/show', 'MedicineController')->middleware('auth');
Route::get('/Medicine/category', 'MedicineController@showCategory')->middleware('auth');
Route::get('/Medicine/category/delete/{id}', 'MedicineController@delete')->middleware('auth');
Route::post('/Medicine/category/addCategory', 'MedicineController@addNewCategory')->middleware('auth');
Route::get('/Medicine/addNewMedicine', 'MedicineController@showAddMedicine')->middleware('auth');
Route::post('/Medicine/addNewMedicine', 'MedicineController@addNewMedicine')->middleware('auth');
Route::get('/Medicine/editMedicine/{id}', 'MedicineController@showEditMedicine')->middleware('auth');
Route::get('/Medicine/delete/{id}', 'MedicineController@deleteMedicine')->middleware('auth');
Route::post('/Medicine/editMedicine/{id}', 'MedicineController@editMedicine')->middleware('auth');
