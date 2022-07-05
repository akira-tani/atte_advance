<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RestTime;

class WorkTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'work_start',
        'work_end',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(RestTime::class);
    }

    public function getRest()
    {
        $total_rest_time = 0;
        $get_rests = $this->rests;
        foreach($get_rests as $get_rest){
            $total_rest_time += $get_rest->countRest();
        }
        if(!($total_rest_time == 0)) {
            return gmdate("H:i:s", $total_rest_time);
        } else {
            return null;
        }
    }
    public function getWork(){
        $work_start = strtotime($this->work_start);
        $work_end = strtotime($this->work_end);
        $work_time = $work_end - $work_start;

        if(!empty($work_end)){
            $get_rests = $this->rests;
            foreach($get_rests as $get_rest){
                $work_time -= $get_rest->countRest();
            }
            return gmdate("H:i:s", $work_time);
        }

    }
}
