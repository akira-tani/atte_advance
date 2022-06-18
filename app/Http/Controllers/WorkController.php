<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkTime;
use App\Models\RestTime;

use Carbon\Carbon;

class WorkController extends Controller
{
    public function start() 
    {
        WorkTime::create([
            'user_id' => Auth::id(),
            'date' => Carbon::now(),
            'work_start' => Carbon::now(),
        ]);

        return redirect('/')->with('message', '勤務を開始しました');
    }

    public function end()
    {
        WorkTime::where('user_id', Auth::id())->where('date', Carbon::today())->update([
            'work_end' => Carbon::now()
        ]);

        return redirect('/')->with('message', '勤務を終了しました');
    }
}
