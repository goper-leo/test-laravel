<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * Guest routes
 */
Route::namespace('Auth')->prefix('auth')->group(function () {
    Route::name('auth.login')->post('login', 'LoginController@index');

    Route::prefix('sign-up')->group(function () {
        Route::name('auth.sign_up')->get('{code}', 'SignUpController@index');
        Route::name('auth.sign_up.store')->post('', 'SignUpController@store');
        Route::name('auth.sign_up.verify')->post('verify', 'SignUpController@verify');
    });
});

/**
 * Auth routes
 */
Route::middleware('auth:sanctum')->group(function () {

    /**
     * User routes
     */
    Route::prefix('user')->namespace('User')->group(function () {
        Route::name('user.me')->get('me', 'IndexController@index');
        Route::name('user.update')->patch('update', 'IndexController@update');
    });

    /**
     * Admin routes
     */
    Route::prefix('admin')->middleware('admin')->namespace('Admin')->group(function () {
        Route::name('admin.user.send.invitations')->post('store', 'InvitationController@store');
    });
});