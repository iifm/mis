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
    return view('mis.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');


//user-details routes
Route::get('/user-details', 'UserDetailController@index')->name('user.index');
Route::get('/user-education/add', 'UserDetailController@education');
Route::get('/education-delete/{id}', 'UserDetailController@educationDelete');

/*Route::get('/user-education/edit', 'UserDetailController@educationedit');
*/
Route::post('/user-education/update', 'UserDetailController@educationAdd');
Route::post('/user-details/store', 'UserDetailController@store');
Route::get('/user-details/edit/{id}', 'UserDetailController@edit');
Route::get('/user-professional', 'UserDetailController@professional');
Route::get('/profession-delete/{id}', 'UserDetailController@professionalDelete');

Route::post('/user-professional/update', 'UserDetailController@professionalAdd');
Route::get('/user-official', 'UserDetailController@official');
Route::post('/user-official/add', 'UserDetailController@officialAdd');
Route::get('/user-personal', 'UserDetailController@personal');
Route::post('/user-personal/add', 'UserDetailController@personalAdd');
Route::get('/user-family', 'UserDetailController@family');
Route::post('/user-family/add', 'UserDetailController@familyAdd');




//leave routes
Route::get('/leave', 'LeaveController@create');
Route::get('/leave-add', 'LeaveController@create')->name('leave.create');
Route::get('/leave-view', 'LeaveController@index')->name('leave.index');
Route::post('/leave-store', 'LeaveController@store');
Route::post('/leave-edit/{id}', 'LeaveController@store');
Route::get('/leave-delete/{id}', 'LeaveController@destroy');


//attendance routes
Route::get('/attendance', 'AttendanceController@index')->name('attendance.index');
Route::post('/attendance/store', 'AttendanceController@store');

//photo-album routes
Route::get('/photo-album', 'PhotoAlbumController@index')->name('photo.index');
Route::get('/photo-album/create', 'PhotoAlbumController@create')->name('photo.create');
Route::post('/photo-album/store', 'PhotoAlbumController@store');
Route::post('/photo-album/add-category', 'PhotoAlbumController@addCategory');


//conveyance routes
Route::get('/conveyance', 'ConveyanceController@create');
Route::get('/conveyance/index', 'ConveyanceController@index')->name('conveyance.index');
Route::post('/conveyance/store', 'ConveyanceController@store');
Route::get('/conveyance/policy', 'ConveyanceController@show');



//hall-of-fame routes
Route::get('/hall-of-fame', 'EOFController@index')->name('eof.index');
Route::get('/hall-of-fame/create', 'EOFController@create');
Route::get('/hall-of-fame/create', 'EOFController@create');
Route::post('/hall-of-fame/store', 'EOFController@store');



//reimbursement routes
Route::get('/reimbursement', 'LeaveController@index')->name('reimbursement.index');

//on-duty routes
Route::get('/on-duty', 'OnDutyController@create');
Route::get('/on-duty/create', 'OnDutyController@create');
Route::get('/on-duty/index', 'OnDutyController@index')->name('od.index');
Route::get('/on-duty/edit/{id}', 'OnDutyController@edit');
Route::get('/on-duty/delete/{id}', 'OnDutyController@destroy');
Route::post('/on-duty/store', 'OnDutyController@store');


//Change Password
Route::get('/cange-password','HomeController@changePasswordView')->name('changePassword');
Route::post('/changePassword','HomeController@changePassword');


//Report 
Route::get('/conveyance-report','ReportController@conveyanceReport')->name('conveyanceReport');
Route::get('/conveyance-report/data','ReportController@conveyanceDate');

/*Route::get('/backup-database','DatabaseBackupController@backup');*/


//Inventory Management Routes
Route::resource('/product','ProductController');

Route::resource('/assign','AssignProductController');
Route::get('/get-product/{category}','AssignProductController@getProduct');

Route::get('/send-mail','LeaveController@sendMail');