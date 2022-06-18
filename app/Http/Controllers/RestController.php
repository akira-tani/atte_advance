<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkTime;
use App\Models\RestTime;

use Carbon\Carbon;

class RestController extends Controller
{
    public function start()
    {
        $work_time = WorkTime::where('user_id', Auth::id())->where('date', Carbon::today())->first();
        RestTime::create([
            'work_time_id' => $work_time->id,
            'date' => Carbon::now(),
            'rest_start' => Carbon::now(),
        ]);

        return redirect('/')->with('message', '休憩を開始しました');
    }

    public function end()
    {
        $work_time = WorkTime::where('user_id', Auth::id())->where('date', Carbon::today())->first();
        $rest_end = RestTime::where('work_time_id', $work_time->id)->latest()->first();
        $rest_end->update([
            'rest_end' => Carbon::now()
        ]);

        return redirect('/')->with('message', '休憩を終了しました');
    }
}
