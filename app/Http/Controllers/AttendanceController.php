<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WorkTime;
use App\Models\RestTime;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->page) {
            $date = $request->date;
        } else {
            $date = Carbon::today()->format("Y-m-d");
        }
        $work_times = WorkTime::where('date', $date)->latest()->paginate(5);
        $work_times->appends(compact('date'));

        return view('attendance', compact('date', 'work_times'));
    }
    public function changeDate(Request $request)
    {
        $request_date = $request->input('date');
        $change_date = $request->input('change_date');

        $carbon = new Carbon($request_date);

        if ($change_date == "back") {
            $calculate_date = $carbon->subDays(1);
        } 
        if ($change_date == "next") {
            $calculate_date = $carbon->addDays(1);
        }
        $date = $calculate_date->format("Y-m-d");
        $work_times = WorkTime::where('date', $date)->latest()->paginate(5);
        $work_times->appends(compact('date'));

        return view('attendance', compact('date', 'work_times'));
    }
    public function getUser(Request $request)
    {
        $name = User::find($request->id)->name;
        $work_times = WorkTime::where('user_id', $request->id)->orderBy('date')->paginate(5);
        return view('user_attendance', compact('name', 'work_times'));
    }
}