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

/*
Route::get('/', function () {
    return view('home');
});
*/
// APIのURL以外のリクエストに対してはhomeに該当するテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する
//Route::get('/{any?}', function () {
 //   return view('home');
//})->where('any', '.*');
//})->where('any', '.+');//任意の文字が1文字以上




// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');
/*
Route::get('/{any}', function () {
    return view('tasks');
})->where('any', '.*');
*/



/*
// 送信メール本文のプレビュー
Route::get('sample/mailable/preview', function () {
    return new App\Mail\SampleNotification();
  });

Route::get('sample/mailable/send', 'StepController@SampleNotification');
*/








/*
Route::group(['middleware' => 'auth'], function(){//練習の為にcheckメソッドを作成している
    Route::get('/step/new', 'StepController@new')->name('step.new');
    Route::post('/step', 'StepController@create')->name('step.create');

    Route::get('/step/{id}/edit/', 'StepController@edit')->name('step.edit');
    Route::post('/step/{id}', 'StepController@update')->name('step.update');
    Route::post('/step/{id}/delete', 'StepController@destroy')->name('step.delete');


    Route::get('/step/{id}', 'StepController@detail')->name('step.detail');
    Route::get('/step/{id}/ko_detail', 'StepController@ko_detail')->name('step.ko_detail');


    Route::get('/mypage', 'StepController@mypage')->name('step.mypage');

    Route::get('/auth/prof_edit', 'UsersController@prof_edit')->name('auth.prof_edit');
    Route::post('/auth', 'UsersController@prof_update')->name('auth.prof_update');

});
*/
/*
Route::get('/step', 'StepController@index')->name('step');

Auth::routes();
Route::get('members/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('members/login', 'Auth\LoginController@login');
Route::post('members/login', 'Auth\LoginController@login')->name('step.mypage');
Route::post('members/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('members/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('members/register', 'Auth\RegisterController@register')->name('step.mypage');

Route::get('members/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('members/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('members/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('members/password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');
*/


//Auth::routes();//////////使用？
//Route::get('/home', 'HomeController@index')->name('home');//////////使用？
