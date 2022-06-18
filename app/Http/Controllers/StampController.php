<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkTime;
use App\Models\RestTime;
use Carbon\Carbon;

class StampController extends Controller
{
    public function index() 
    {
        $work_start = null;
        $work_end = null;
        $rest_start = null;
        $rest_end = null;

        $attendance = WorkTime::where('user_id', Auth::id())->where('date', Carbon::today())->first();

        if (!empty($attendance)) {
            $work_start = $attendance->work_start;
            $work_end = $attendance->work_end;
            $rest = RestTime::where('work_time_id', $attendance->id)->latest()->first();
            if (!empty($rest)) {
                $rest_start = $rest->rest_start;
                $rest_end = $rest->rest_end;
            }
        }

        return view('stamp', compact('work_start', 'work_end', 'rest_start', 'rest_end'));
    }
}
