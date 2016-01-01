<?php
use Illuminate\Http\Request;
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

#rereoute to the login
Route::get('/', 		function(){ return Redirect::to('/crm/login');  });
Route::get('/crm', 		function(){ return Redirect::to('/crm/login');  });

# Login, Logout Routing ...
Route:: resource('/crm/login', 'LoginController');
Route:: get('/crm/logout', 					array('uses'=>'LoginController@doLogout', 	'as'=>'crm.logout'));
Route:: get('/crm/relogin', 				array('uses'=>'LoginController@doRelogin', 	'as'=>'crm.relogin'));
Route::post('/crm/user/forget_password', 	array('uses'=>'LoginController@processForgetPassword', 	'as'=>'crm.forget_password'));

# Home Related Routing ----------------------------------------------------------------------------------------
Route::get('/crm/home', 					array('uses'=>'HomeController@showHome'));

# Profile Related Routing ----------------------------------------------------------------------------------------
Route::get('/crm/profile', 					array('uses'=>'ProfileController@showUserProfile', 			'as'=>'crm.profile.index'));
Route::get('/crm/profile/edit', 			array('uses'=>'ProfileController@editUserProfile', 			'as'=>'crm.profile.edit'));
Route::post('/crm/profile/update',		 	array('uses'=>'ProfileController@updateUserProfile', 		'as'=>'crm.profile.update'));
// Route::post('/crm/user/ajax/upload_image', 	array('uses'=>'ProfileController@profileImageUpload', 		'as'=>'crm.user.ajax.upload_image'));
Route::post('/crm/user/change_password', 	array('uses'=>'ProfileController@processChangePassword',	'as'=>'crm.user.change_password'));


Route::resource('/crm/user', 'UserController'); # resource routing

Route::get('/crm/feature/{fid}/permission/create', array('uses'=>'FeatureController@createPermission', 'as'=>'crm.feature.create_permission'));
Route::post('/crm/feature/{fid}/permission', array('uses'=>'FeatureController@storePermission', 'as'=>'crm.feature.store_permission'));
Route::get('/crm/feature/{fid}/permission/{pid}/edit', array('uses'=>'FeatureController@editPermission', 'as'=>'crm.feature.edit_permission'));
Route:: put('/crm/feature/{fid}/permission/{pid}', array('uses'=>'FeatureController@updatePermission', 'as'=>'crm.feature.update_permission'));
Route::delete('/crm/feature/{fid}/permission/{pid}', array('uses'=>'FeatureController@deletePermission', 	'as'=>'crm.feature.delete_permission'));
Route::resource('/crm/feature', 'FeatureController'); # resource routing

Route::delete('/crm/role/{rid}/user/{uid}/remove', array('uses'=>'RoleController@removeRoleUser', 'as'=>'crm.role.user.user_remove'));
Route:: get('/crm/role/{rid}/user_assign', array('uses'=>'RoleController@assignRoleUserForm', 'as'=>'crm.role.user.user_assign_form'));
Route::post('/crm/role/{rid}/user_assign', array('uses'=>'RoleController@assignRoleUser', 'as'=>'crm.role.user.user_assign'));
Route:: get('/crm/role/{rid}/feature_assign', array('uses'=>'RoleController@assignRoleFeatureForm', 	'as'=>'crm.role.feature.feature_assign_form'));
Route::post('/crm/role/{rid}/feature_assign', array('uses'=>'RoleController@assignRoleFeature', 'as'=>'crm.role.feature.feature_assign'));
Route::post('/crm/role/{rid}/permission_assign', array('uses'=>'RoleController@assignRolePermission', 'as'=>'crm.role.permission_assign'));
Route::delete('/crm/role/{rid}/feature/{fid}/remove', array('uses'=>'RoleController@removeRoleFeature', 'as'=>'crm.role.feature.feature_remove'));
Route::resource('/crm/role', 'RoleController');

Route::resource('/crm/system_setting', 'SystemSettingController');
Route::resource('/crm/mail_setting', 'MailSettingController');
Route::resource('/crm/permission_pos_type', 'PermPosTypeSettingController');
Route::resource('/crm/system_icon', 'SystemIconController');

// Post Routes ------------------------------------------------------------------------------------->
Route::resource('/crm/post', 'PostController');

// Notification Routes ------------------------------------------------------------------------------------->
Route::resource('/crm/notification', 'NotificationController');


// API Routes Start ------------------------------------------------------------------------------------->
Route::group(array('prefix' => '/api/v1'), function(){
	Route::post('login', 'Api\v1\LoginApiController@login');
	Route::post('get_posts', 'Api\v1\PostApiController@getPosts');
	Route::post('get_post', 'Api\v1\PostApiController@getPost');
	Route::post('like_post', 'Api\v1\PostApiController@likePost');
	Route::post('unlike_post', 'Api\v1\PostApiController@unlikePost');
	Route::post('get_notifications', 'Api\v1\NotificationApiController@getNotifications');
	Route::post('post_comment', 'Api\v1\CommentApiController@postComment');
	Route::post('get_comments', 'Api\v1\CommentApiController@getComments');
});
// API Routes End ------------------------------------------------------------------------------------->




/*Start Test Routes*/
Route::post('/test/pns', function () {
  $deviceToken = Input::get('device_token');
  PushNotification::app('l5fAndroid')
              ->to($deviceToken)
              ->send('Hello World, i`m a push message');
});

Route::post('/test/artisan', function (Request $request) {
	$command = $request->get('command');
	$exitCode = Artisan::call($command, [
	    '--force' => true,
	]);
	return $exitCode;
});
/*End Test Routes*/
