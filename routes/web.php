<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CustomerPhones\CustomerPhonesController;

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

Route::get('/', [CustomerPhonesController::class, 'index']);
Route::get('/ajax-list-phones', [CustomerPhonesController::class, 'ajaxListPhones'])
    ->name('ajax_list_phones');
