<?php

namespace App\Http\Controllers;

use App\GPXStart;
use App\Models\Activity;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ActivityController extends Controller
{

    public function gpxsave(Request $request){
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
            $activity->duration = $gpx->GetStat()->duration;
            $activity->movingtime = $gpx->MovingTime();
            $activity->distance = $gpx->GetStat()->distance;
            $activity->avrspeed = $gpx->GetStat()->averageSpeed;
            $activity->avrpace = $gpx->GetStat()->averagePace;
            $activity->minaltitude = $gpx->GetStat()->minAltitude;
            $activity->maxaltitude = $gpx->GetStat()->maxAltitude;
            $activity->elevationgain = $gpx->GetStat()->cumulativeElevationGain;
            $activity->elevationloss = $gpx->GetStat()->cumulativeElevationLoss;
            $activity->started_at = $gpx->GetStat()->startedAt;
            $activity->finished_at = $gpx->GetStat()->finishedAt;
            $activity->user_id = Auth::id();
            $activity->gpx = $gpx->GetContent();
            try {
                $activity->save();
            }catch (Exception $err){
                abort('500','Do not save GPX track');
            }

        }
        return Redirect::route('dashboard');
    }
}
