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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'HomeController@index');
Route::get('/detail/{item}', 'HomeController@show');
Route::get('/kategori/{kategori}', 'HomeController@kategori');
Route::resource('/cart', 'CartController');
Route::delete('/emptycart','CartController@emptycart');

Auth::routes();

Route::get('verifikasiemail/{email}/{register_token}', 'Auth\RegisterController@verifikasiemail')->name('verifikasiemail');
// Route::get('/login', 'AuthController@login');
// Route::post('/postlogin', 'AuthController@postlogin');
// Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'checkRole:1'], function(){
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/items', 'StokController@index');
	Route::get('/items/create', 'StokController@create');
	Route::post('/items', 'StokController@store');
	Route::delete('/items/{item}', 'StokController@destroy');
	Route::get('/items/{item}/edit', 'StokController@edit');
	// Route::get('/{item}/edit', 'StokController@edit');
	Route::patch('/items/{item}', 'StokController@update');
	Route::delete('/items', 'StokController@hapus_semua_item');
	Route::get('/invoice', 'DashboardController@invoice');
	Route::get('/detail_invoice/{invoice}', 'DashboardController@detail_invoice');
	Route::delete('/invoice/{invoice}', 'DashboardController@destroy_invoice');
	Route::get('/sold/{item}', 'DashboardController@stok_laku');
	Route::get('/sold_more/{item}', 'DashboardController@form_laku_banyak');
	Route::patch('/sold_more/{item}', 'DashboardController@laku_banyak');
	Route::get('/transaksi', 'DashboardController@transaksi');
	Route::delete('/transaksi/{transaction}', 'DashboardController@hapus_transaksi');
	Route::delete('/transaksi', 'DashboardController@hapus_semua_transaksi');
	Route::get('/recapitulation', 'DashboardController@rekap_transaksi');
	Route::get('/rekapitulasi', 'DashboardController@rekapitulasi');
	Route::delete('/rekapitulasi/{recapitulation}', 'DashboardController@hapus_rekapitulasi');
	Route::delete('/rekapitulasi', 'DashboardController@hapus_semua_rekapitulasi');
});
	
Route::group(['middleware' => 'checkRole:1,2'], function(){
	Route::get('/member', 'MemberController@index');
	Route::get('/member_kategori/{kategori}', 'MemberController@kategori');
	Route::get('/member_detail/{item}', 'MemberController@show');
	Route::resource('/cartmember', 'CartMemberController');
	Route::delete('/emptycartmember', 'CartMemberController@emptycartmember');
	Route::get('/payment', 'MemberController@payment');
	Route::post('/pesanan', 'MemberController@proses_pesanan');
	Route::get('/profil', 'MemberController@profil');
	Route::get('/edit_profil', 'MemberController@edit_profil');
	Route::patch('/update_profil', 'MemberController@update_profil');
});

// Route::get('/home', 'HomeController@index')->name('home');
