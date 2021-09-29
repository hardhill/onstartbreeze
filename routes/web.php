<?php

use App\GPXStart;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::post('gpx/save',function(Request $request){
    $files = $request->files;
    if($files->count()>0){
        $s = $_FILES['file']['tmp_name'];
        $gpx = new GPXStart($s);
        $activity = new Activity();
        $activity->trackid = $gpx->GetIdTrack();
        $activity->title = $gpx->GetTitle();
        $activity->category_id = 1;
        $activity->creator = $gpx->GetFile()->creator;
        $activity->start_at = $gpx->GetTimeStart();
        $activity->user_id = Auth::id();
        $activity->gpx = $gpx->GetContent();
        try {
            $activity->save();
        }catch (Exception $err){
            abort('500','Do not save GPX track');
        }

    }
    return Redirect::route('dashboard');
})->middleware(['auth'])->name('gpx.save');

require __DIR__.'/auth.php';
