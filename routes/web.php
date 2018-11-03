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
})->name('root');

Auth::routes();

Route::get('/home', 'HomeController@dashboard')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');


//user-details routes
Route::get('/user-details', 'UserDetailController@index')->name('user.index');
Route::get('/user-details/{id}', 'UserDetailController@index')->name('search_user');
Route::get('/user-education/add/{id}', 'UserDetailController@education');
Route::get('/education-delete/{id}/{user_id}', 'UserDetailController@educationDelete');
Route::get('/education-edit/{id}/{user_id}', 'UserDetailController@educationEdit');
Route::post('/user/education/update/{id}/{user_id}','UserDetailController@userEducationUpdate');

Route::post('/user-education/update/{id}', 'UserDetailController@educationAdd');
Route::get('/user-professional/{id}', 'UserDetailController@professional');
Route::get('/profession-delete/{id}/{user_id}', 'UserDetailController@professionalDelete');
Route::post('/user-professional/update/{id}', 'UserDetailController@professionalAdd');
Route::get('/user-professional/edit/{id}/{user_id}','UserDetailController@professionalEdit');
Route::post('/user/professional/update/{id}/{user_id}','UserDetailController@professionalUpdate');

Route::get('/user-official/{id}', 'UserDetailController@official');
Route::post('/user-official/add/{id}', 'UserDetailController@officialAdd');
Route::get('/user-personal/{id}', 'UserDetailController@personal');
Route::post('/user-personal/add/{id}', 'UserDetailController@personalAdd');
Route::get('/user-family/{id}', 'UserDetailController@family');
Route::post('/user-family/add/{id}', 'UserDetailController@familyAdd');


//leave routes
Route::get('/leave', 'LeaveController@create');
Route::get('/leave-add', 'LeaveController@create')->name('leave.create');
Route::get('/leave-view/{id}', 'LeaveController@index')->name('leave.index');
Route::post('/leave-store', 'LeaveController@store');
Route::post('/leave-edit/{id}', 'LeaveController@store');
Route::get('/leave-delete/{id}', 'LeaveController@destroy');
Route::get('leave-approval/{id}','LeaveController@leaveApproval')->name('leave-approval');
Route::post('leave-approved/{id}/{uid}','LeaveController@leaveApproved')->name('leave-approved');


//attendance routes
Route::get('/attendance', 'AttendanceController@index')->name('attendance.index');
Route::post('/attendance/store', 'AttendanceController@store');
Route::get('/attendance-view/{id}','AttendanceController@viewAttendance')->name('attendance-view');

Route::get('/attendance-view','AttendanceController@viewAttendance');

Route::get('/self-attendace-detail','AttendanceController@attendanceDetails');
Route::get('/update-user-attendance/{id}/{date}/{type}','AttendanceController@updateInAttendance');
Route::post('/updated-user-attendance','AttendanceController@updateIn');
Route::get('/update-user-out-attendance/{id}/{date}/{type}','AttendanceController@updateOutAttendance');
Route::post('/updated-userout-attendance','AttendanceController@updateOut');
Route::get('/attendance-approval/{id}/{user_id}','AttendanceController@attendanceApprove')->name('attendanceApprove');
Route::get('/update-attendance/both/{id}','AttendanceController@UpdateBothAttendanceApprove')->name('updateBothAttendance');
Route::post('/attendance-approved/{id}/{from}/{user_id}','AttendanceController@attendanceApproved');
Route::get('/update-attendance/{user_id}/{date}','AttendanceController@updateBothAttendance');
Route::post('/update-attendance/store/{user_id}/{date}','AttendanceController@storeUpdatedAttendance');
Route::post('/update-attendance/approved/store/{id}','AttendanceController@StoreUpdateBothAttendanceApprove');


//photo-album routes
Route::get('/photo-album', 'PhotoAlbumController@index')->name('photo.index');
Route::get('/photo-album/create', 'PhotoAlbumController@create')->name('photo.create');
Route::post('/photo-album/store', 'PhotoAlbumController@store');
Route::post('/photo-album/add-category', 'PhotoAlbumController@addCategory');
Route::get('/photo-album-delete/{id}','PhotoAlbumController@destroy');


//conveyance routes
Route::get('/conveyance', 'ConveyanceController@create');
Route::get('/conveyance/index/{id}', 'ConveyanceController@index')->name('conveyance.index');
Route::post('/conveyance/store', 'ConveyanceController@store');
Route::get('/conveyance/policy', 'ConveyanceController@show');
Route::get('/conveyance-approve/{id}/{amount}/{approver}','ConveyanceController@approveConveyance');
Route::get('/conveyance/re-action/{id}','ConveyanceController@reAction');



//hall-of-fame routes
Route::get('/hall-of-fame', 'EOFController@index')->name('eof.index');
Route::get('/hall-of-fame/create', 'EOFController@create');
Route::get('/hall-of-fame/create', 'EOFController@create');
Route::post('/hall-of-fame/store', 'EOFController@store');
Route::get('employee-department/{id}','EOFController@getDepartment');



//reimbursement routes
Route::get('/reimbursement', 'LeaveController@index')->name('reimbursement.index');

//on-duty routes
Route::get('/on-duty', 'OnDutyController@create');
Route::get('/on-duty/create', 'OnDutyController@create');
Route::get('/on-duty/index/{id}', 'OnDutyController@index')->name('od.index');
Route::get('/on-duty/edit/{id}', 'OnDutyController@edit');
Route::get('/on-duty/delete/{id}', 'OnDutyController@destroy');
Route::post('/on-duty/store', 'OnDutyController@store');


//Change Password
Route::get('/change-password','HomeController@changePasswordView')->name('changePassword');
Route::post('/changePassword/store','HomeController@changePassword');


//Report 
Route::get('/conveyance-report','ReportController@conveyanceReport')->name('conveyanceReport');
Route::get('/conveyance-report/data','ReportController@conveyanceDate');
Route::get('/attendance-report','ReportController@attendanceReport')->name('attendanceReport');
Route::get('/attendance-report/data','ReportController@attendanceData');
Route::get('/leave-report','ReportController@leaveReport')->name('leaveReport');
Route::get('/leave-report/data','ReportController@leaveDate');


//Inventory Management Routes
Route::resource('/product','ProductController');

Route::resource('/assign','AssignProductController');
Route::get('/get-product/{category}','AssignProductController@getProduct');

Route::get('/send-mail','LeaveController@sendMail');

//dashboard routes
Route::get('/send-wish/{id}/{subject}','HomeController@sendWish');
Route::post('/wish-send','HomeController@wishEmail')->name('wish-send');

//search routes
Route::get('/search-employee','SearchController@index');
Route::get('/search/user/action/{search}','SearchController@Search');
Route::get('/search/user/{id}','SearchController@searchResult')->name('search_result');
Route::get('/search-by-department/{department}','SearchController@searchByDepartment');


//user management routes
Route::get('/user-management/index','UserManagementController@index')->name('usermanagement.index');
Route::get('user-management/view/{id}','UserManagementController@show');
Route::get('/user-management/edit/{id}','UserManagementController@edit');
Route::get('/update-user-status/{id}','UserManagementController@statusEdit');
Route::get('/edit-user-details/option/{id}','UserManagementController@editOption');

//admin zone
Route::get('admin/news-index','AdminController@index')->name('news.index');
Route::get('admin/news-edit/{id}','AdminController@edit');
Route::get('admin/news-delete/{id}','AdminController@destroy');
Route::get('admin/news-upload','AdminController@uploadNews');
Route::post('admin/news-upload/store','AdminController@uploadstore');
Route::post('admin/news-upload/update/{id}','AdminController@update');


//policy
Route::get('/policy-view/{id}','PolicyController@index')->name('policy.index');
Route::get('/policy/edit/{id}','PolicyController@create');
Route::post('/policy/update/{id}','PolicyController@policyUpdate');

//department
Route::get('/department/index','DepartmentController@index')->name('department.index');
Route::get('/department/create','DepartmentController@create');
Route::post('/department/store','DepartmentController@store');
Route::get('/department/edit/{id}','DepartmentController@edit');
Route::post('/department/update/{id}','DepartmentController@update');
Route::get('/department/delete/{id}','DepartmentController@destroy');

//reset password
Route::get('/reset-password','ResetPasswordController@index')->name('reset-password');
Route::post('/reset-password/send','ResetPasswordController@sendEmail');
Route::get('/reset-password/form/{id}','ResetPasswordController@sendResetPasswordForm')->name('reset-password-form');
Route::post('/reset-password/change-password/{id}','ResetPasswordController@passwordChanged');

//upload category routes
Route::get('/upload/category/index','UploadCategoryController@index')->name('uploadCategory.index');
Route::get('/upload/category/create','UploadCategoryController@create');
Route::post('/upload/category/store','UploadCategoryController@store');
Route::get('/upload/category/edit/{id}','UploadCategoryController@edit');
Route::post('/upload/category/update/{id}','UploadCategoryController@update');
Route::get('/upload/category/delete/{id}','UploadCategoryController@destroy');

//downloads routes
Route::get('/download/{id}','DownloadController@index');
Route::get('/post/view/{id}','HomeController@postView');
Route::get('/download/delete/{id}','DownloadController@destroy');

//product category
Route::get('/product-categories/index','ProductCategoryController@index')->name('product.category');
Route::get('/product-categories/create','ProductCategoryController@create');
Route::post('/product-categories/store','ProductCategoryController@store');
Route::get('/product-categories/edit/{id}','ProductCategoryController@edit');
Route::get('/product-categories/delete/{id}','ProductCategoryController@destroy');
Route::post('/product-categories/update/{id}','ProductCategoryController@update');

//feedback 
Route::get('/feedback/index','FeedbackController@index')->name('feedback.index');
Route::post('/feedback/store','FeedbackController@store');

//role management
Route::get('/role/index','RoleController@index')->name('role.index');
Route::get('/role/create','RoleController@create');
Route::post('/role/store','RoleController@store');
Route::get('/role/edit/{id}','RoleController@edit');
Route::post('/role/update/{id}','RoleController@update');
Route::get('/role/delete/{id}','RoleController@destroy');

//manager zone
Route::get('/manager/index','ManagerController@index')->name('manager.index');
Route::get('/manager/leave/index','ManagerController@managerLeaveIndex')->name('manager.leave.index');
Route::get('/manager/attendance/index','ManagerController@managerAttendanceIndex')->name('manager.attendance.index');


//database migration
Route::get('/database/migration','DataBaseMigrationController@index');

//assign user role
Route::get('assign-role/index','AssignUserRoleController@index')->name('assign_role.index');
Route::get('assign-role/edit/{id}','AssignUserRoleController@roleUpdate');

//request
Route::get('manager-zone/request','RequestController@index');
Route::post('manager-zone/request/store','RequestController@store');
Route::get('manager-zone/request/show-all','RequestController@show');
Route::get('manager-zone/request/view-detail/{id}','RequestController@viewDetail');

//user's Manager
Route::get('admin/user-manager/index','UserManagerController@index');

Route::get('admin/report/leave-summary','ReportController@leaveSummaryReport');