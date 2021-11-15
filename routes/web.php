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

Route::get('/', 'FrontendController@index')->name('front.index');
Route::get('lowongan/detail/{id}', 'FrontendController@singleJob')->name('front.lowongan.detail');
Route::get('lowongan/melamar/{id}', 'FrontendController@applyForJob')->name('front.lowongan.lamar');
Route::post('lowongan/melamar', 'FrontendController@submitVacancy')->name('front.lowongan.apply');
Route::post('lowongan/melamar/khusus', 'FrontendController@submitVacancyKhusus')->name('front.lowongan.apply.khusus');
Route::get('lowongan/terdaftar', 'FrontendController@registered')->name('front.lowongan.registered');
Route::get('lowongan/gagal-daftar', 'FrontendController@failed')->name('front.lowongan.failed');
Route::get('artikel/detail/{id}', 'FrontendController@singleArticle')->name('front.artikel.detail');
Route::get('formasi/umum/', 'FrontendController@getUmum')->name('front.formasi.umum');
Route::get('formasi/khusus/', 'FrontendController@getKhusus')->name('front.formasi.khusus');
Route::get('formasi', 'FrontendController@getFormation')->name('front.formasi.detail');
Route::get('pelamar/status', 'FrontendController@pageStatus')->name('front.pelamar.checkpage');
Route::POST('pelamar/status', 'FrontendController@checkStatus')->name('front.pelamar.check');
Route::POST('pelamar/status/print', 'FrontendController@printCard')->name('front.pelamar.print');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/sysadmin', function () {
        return view('auth.login');
    });
});

Auth::routes();

Route::group([
    'prefix' => 'sysadmin',
    'middleware' => ['auth'],
    'middleware' => ['role:administrator|superadministrator|opd'],
    'namespace' => 'Admin'
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('users', 'UsersController', ['middleware' => ['permission:read-users|create-users']]);
    Route::resource('permission', 'PermissionController');
    Route::resource('roles', 'RolesController');
    Route::resource('opd', 'OpdController');
    Route::resource('lowongan', 'VacancyController');
    Route::resource('artikel', 'ArticleController');
    Route::resource('kategori', 'ArticlecategoryController');
    Route::resource('dokumen', 'VacancydocController');
    Route::resource('pelamar', 'CandidateController');
    Route::get('pelamar/download/{id}', 'CandidateController@download');
    Route::resource('khusus', 'CandidateKhususController');
    Route::get('khusus/download/{id}', 'CandidateKhususController@download');
    Route::resource('periods', 'PeriodeController');
});