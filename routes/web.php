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

Route::get('/', 'HomeController@index')->name('index');

Route::group(['middleware' => ['authMiddle', 'autoLogout']], function () {

    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/logout', 'UserController@logout')->name('logout');

    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile/{idUser}', 'UserController@update')->name('profile.upload');

    Route::group(['prefix' => 'course'], function () {
        Route::get('/', 'CourseController@list');
        Route::post('/create', 'CourseController@create')->name('course.create');
        Route::post('/edit/{id}', 'CourseController@edit')->name('course.edit');
    });

    Route::group(['prefix' => 'group'], function () {
        Route::get('/{id}', 'GroupController@list')->name('group.list');
        Route::post('/{id}', 'GroupController@create')->name('group.create');
        Route::get('/home/{id}', 'GroupController@home')->name('group.detail');
        Route::post('/home/uploadavatar/{id}', 'GroupController@uploadAvatar')->name('group.uploadAvatar');
        Route::post('/home/uploadcover/{id}', 'GroupController@uploadCover')->name('group.uploadCover');
        Route::get('/content/approve/{idGroup}/{id}', 'GroupController@approve')->name('content.approve');
        Route::get('/content/decline/{idGroup}/{id}', 'GroupController@decline')->name('content.decline');

        Route::group(['prefix' => 'setting'], function () {
            Route::post('/changeName/{id}','GroupController@changeName')->name('setting.changeName');
            Route::post('/changeDes/{id}','GroupController@changeDes')->name('setting.changeDes');
            Route::post('/changeAvatar/{id}','GroupController@changeAvatar')->name('setting.changeAvatar');
            Route::post('/changeCover/{id}','GroupController@changeCover')->name('setting.changeCover');
    });

    });

    Route::group(['prefix' => 'member'], function () {
        Route::get('/remove/{idGroup}/{id}', 'UserController@remove')->name('member.remove');
        Route::get('/setmentor/{idGroup}/{id}', 'UserController@setMentor')->name('member.setMentor');
        Route::get('/setCaption/{idGroup}/{id}', 'UserController@setCaption')->name('member.setCaption');
        Route::get('/removeMentor/{idGroup}/{id}', 'UserController@removeMentor')->name('member.removeMentor');
        Route::get('/wanttolearn/{idGroup}/{id}', 'UserController@getInfor')->name('member.wanttolearn');
        Route::get('/approve/{idGroup}/{id}', 'UserController@approve')->name('member.approve');
        Route::get('/decline/{idGroup}/{id}', 'UserController@decline')->name('member.decline');
        Route::get('/leave/{idGroup}/{id}', 'UserController@acceptLeave')->name('member.leave');
        Route::post('/fetch', 'MemberController@fetch')->name('member.fetch');
        Route::post('/add/{id}', 'MemberController@add')->name('member.add');
        Route::post('attendance/{idCourse}','AttendanceController@attendance');
    });

    Route::group(['prefix' => 'content'], function () {
        Route::post('/create/{id}','ContentController@create')->name('content.create');
        Route::post('/edit/{id}', 'ContentController@edit')->name('content.edit');
        Route::get('/delete/{id}', 'ContentController@delete')->name('content.delete');
        Route::get('/detail/{id}','ContentController@detail')->name('content.detail');
        Route::post('/create-event/{id}','ContentController@createEvent')->name('content.create-event');
    });

});

Route::group(['prefix' => '/login', 'as' => 'login.'], function () {
    Route::get('/google', 'Auth\LoginController@redirectToProvider')->name('google.social');
    Route::get('/google/callback', 'Auth\LoginController@handleProviderCallback');
});
