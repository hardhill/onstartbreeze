<?php


use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),

    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    $activities = Activity::all();
    return Inertia::render('Dashboard',['activities'=>$activities]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('gpx/save',[ActivityController::class,'gpxsave'])->middleware(['auth'])->name('gpx.save');

require __DIR__.'/auth.php';
