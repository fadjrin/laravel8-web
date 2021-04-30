<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementDashboardController;

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
    return view('welcome');
});


Route::group(['middleware' => ['auth']],function(){
	Route::get('/dashboard', [ManagementDashboardController::class, 'index'])->name('dashboard');

	Route::prefix('page')->group(function(){
		Route::get('template/{template?}', [ManagementDashboardController::class, 'gettemplate'])->name('page.template');
		Route::post('template', [ManagementDashboardController::class, 'updatepage'])->name('page.updatetemplate');
	});

	Route::get('/table', function () {
	    return view('table');
	})->name('table');

	Route::get('/chart', function () {
	    return view('chart');
	})->name('chart');	

	Route::get('/gambar', function () {
	    return view('gambar');
	})->name('gambar');		

	Route::get('/video', function () {
	    return view('video');
	})->name('video');			
});

require __DIR__.'/auth.php';
