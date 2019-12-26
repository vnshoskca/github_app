<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {// 認証が必要ないメソッド
    //Route::prefix('api')->group(function () {// 認証が必要ないメソッド
    //Route::group(["middleware" => "api"], function () {// 認証が必要ないメソッド
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');
        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');
        // Send reset password mail
        Route::post('reset-password', 'AuthController@sendPasswordResetLink');
        // handle reset password form process
        Route::post('reset/password', 'AuthController@callResetPassword');

        Route::middleware('auth:api')->group(function () {// 認証が必要なメソッド
        //Route::group(['middleware' => ['jwt.auth']], function () {// 認証が必要なメソッド
            // Get user info
            Route::get('user', 'AuthController@user');
            // Logout user from application
            Route::post('logout', 'AuthController@logout');
            
        });
    });
    // STEP一覧
    Route::get('steps', 'StepController@index');
    //STEP詳細 + 子STEP一覧
    Route::get('/steps/{id}/detail', 'StepController@detail');
    //子STEP
    Route::get('/steps/{id}/ko_detail/{id2}', 'StepController@ko_detail');

    //ユーザー情報の変更
    Route::get('/user/prof_edit', 'UsersController@prof_edit');
    Route::post('/user', 'UsersController@prof_update');
    Route::get('/user/image_edit', 'UsersController@image_edit');
    Route::post('/user/image_update', 'UsersController@image_update');

    //マイページ
    Route::get('/mypage', 'StepController@mypage');
    Route::get('/mypage/registed', 'StepController@mypage_registed');
    Route::get('/mypage/challenged', 'StepController@mypage_challenged');
    
    // STEP登録
    Route::get('/step/new', 'StepController@new');
    Route::post('/step/create', 'StepController@create');
    //STEP編集//STEP更新
    Route::get('/steps/{id}/edit', 'StepController@edit');
    Route::post('/steps/{id}/update', 'StepController@update');
    Route::get('/steps/{id}/edit_category', 'StepController@edit_category');
    Route::post('/steps/{id}/update_category', 'StepController@update_category');
    //STEP削除
    Route::delete('/steps/{id}/delete', 'StepController@destroy');
    //Route::delete('/step/delete', 'StepController@delete');
    //STEPチャレンジ
    Route::post('/steps/{id}/challenge_step', 'StepController@challenge_step');
    //子STEPクリア
    Route::post('/steps/{id}/clear_ko_step/{id2}', 'StepController@clear_ko_step');
    //子STEPクリアカウント
    Route::post('/steps/{id}/progress_ko_step/{id2}', 'StepController@progress_ko_step');
    //Twitter
    Route::post('/steps/{id}/twitter', 'StepController@twitter');

    //子STEP登録
    Route::get('/steps/{id}/ko_detail_new', 'StepController@ko_detail_new');
    Route::post('/steps/{id}/ko_detail_create', 'StepController@ko_detail_create');
    //子STEP編集//子STEP更新
    Route::get('/steps/{id}/edit_ko_step/{id2}', 'StepController@edit_ko_step');
    Route::post('/steps/{id}/update_ko_step/{id2}', 'StepController@update_ko_step');
    //子STEP削除
    Route::delete('/steps/{id}/delete_ko_step/{id2}', 'StepController@destroy_ko_step');
});

/*
Route::middleware(['cors'])->group(function () {//要る?
    Route::options('accounts', function () {
        return response()->json();
    });
    Route::post('accounts', 'AccountController@create');
});
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {//使用///////////////
//Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*
Route::middleware('auth:api')->get('/login', function (Request $request) {
    return $request->user();
});
*/
/*
Route::group(['middleware' => 'api'], function() {//使用///////////////
    Route::get('/steps',  'StepController@index');
});
*/



//->middleware('check'); //単発 使わない
/*
Route::group(['middleware' => 'check'], function() { //一括 //checkは練習。authが使える
    //各処理
});
*/

/*
Auth::routes();
// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/authenticate', 'AuthenticateController@authenticate');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('me', 'AuthenticateController@getCurrentUser');
});
*/
/*
// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');
// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//パスワードリマインダー
//Route::post('/password_re', 'Auth\____Controller@password_re')->name('password_re');////
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
*/

// ログインユーザー
//Route::get('/user', function () {
//  return Auth::user();
//})->name('user');
