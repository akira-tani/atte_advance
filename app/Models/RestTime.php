<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkTime;

class RestTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_time_id',
        'rest_start',
        'rest_end',
    ];

    public function countRest()
    {
        $rest_start = strtotime($this->rest_start);
        $rest_end = strtotime($this->rest_end);
        if (!empty($rest_end)) {
            $rest_time = $rest_end - $rest_start;
            return $rest_time;
        }
    }
}
