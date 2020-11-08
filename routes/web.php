<?php

use App\Events\TaskEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('event', function () {
    event(new TaskEvent('Hello From Laravel Broadcasting'));
    return 'ok';
});

Route::view('listen', 'listenBroadcast');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');
