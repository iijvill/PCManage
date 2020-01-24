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

Route::get('/', function(){
    return redirect('/show');
});

Route::get('/show', 'PCManageController@showPCList');
Route::get('show/detail/{id}', 'PCManageController@showPCDetail');

Route::post('/search', 'PCManageController@search');
Route::get('/search', 'PCManageController@showSearchPage');

//QRコードを読み取ってアクセス！PCの情報を返す
//スマホアクセス
Route::post('/stockconfirm/send', 'StockConfirmController@stockCheck');
Route::get('/stockconfirm/thanks', function(){
    return view('pcmanage/thanks');
});
Route::get('/stockconfirm/{id?}', 'StockConfirmController@stockConfirm');   //スマホはこのページのみを想定
//スマホアクセスここまで

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login/send', 'Auth\LoginController@login');

Route::post('/regist', 'Auth\LoginController@regist');
Route::get('/logout', 'Auth\LoginController@logout');


//管理者専用ページ群
Route::group(['middleware' => 'auth.admin.token'], function(){

    Route::get('/modechange', 'PCManageController@showModeChangePage');
    Route::post('/modechange/send', 'StockConfirmController@modeChange');

    Route::get('/stockcheck', 'StockConfirmController@showStockCheckPage');
    Route::post('/stockcheck/send', 'StockConfirmController@stockCheck');

    //棚卸しモード以外ならアクセス可能にする
    Route::group(['middleware' => 'check.system.mode'], function(){
        Route::get('/add', 'PCManageController@showAddPage'); 
        Route::post('/add', 'PCManageController@add'); 

        Route::post('/edit', 'PCManageController@edit'); 

        Route::get('/employee', 'EmployeeController@showEmployee');
        Route::get('/employee/add', 'EmployeeController@showEmployeeAdd');
        Route::post('/employee/add', 'EmployeeController@employeeAdd');
        Route::post('/employee/edit', 'EmployeeController@employeeEdit');
        Route::get('/employee/edit/{id}', 'EmployeeController@showEmployeeEdit');

        Route::get('/department', 'InformationController@showDepartment');
        Route::post('/department/add', 'InformationController@addDepartment');
        Route::post('/department/send', 'InformationController@editDepartment');
        
        Route::get('/pcmaker', 'InformationController@showPCMaker');
        Route::post('/pcmaker/add', 'InformationController@addPCMaker');
        Route::post('/pcmaker/send', 'InformationController@editPCMaker');

        Route::get('/os', 'InformationController@showOS');
        Route::post('/os/add', 'InformationController@addOS');
        Route::post('/os/send', 'InformationController@editOS');

        Route::get('/cpu', 'InformationController@showCPU');
        Route::post('/cpu/add', 'InformationController@addCPU');
        Route::post('/cpu/send', 'InformationController@editCPU');


        Route::get('/antivirus', 'InformationController@showAntivirus');
        Route::post('/antivirus/add', 'InformationController@addAntivirus');
        Route::post('/antivirus/send', 'InformationController@editAntivirus');

        Route::get('/pctype', 'InformationController@showPCtype');
        Route::post('/pctype/add', 'InformationController@addPCtype');
        Route::post('/pctype/send', 'InformationController@editPCtype');

        Route::get('/qr/verify', 'QRController@showVerifyPage');
        Route::get('/qr/show', 'QRController@showQRCode');
        Route::get('/qr/update', 'QRController@updateURL');
    });
});
