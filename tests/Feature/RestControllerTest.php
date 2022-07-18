<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use App\Models\RestTime;
use Auth;
use Carbon\Carbon;

class RestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStart()
    {
        $today = Carbon::today()->format('Y-m-d');
        $user = User::factory()->create();
        $work_time = WorkTime::factory()->create([
            'user_id' => $user->id,
            'date' => $today,
        ]);

        $rest_time = RestTime::where('work_time_id', $work_time->id)->first();

        $this->assertNull($rest_time);

        $response = $this->actingAs($user)->post('rest-start');
        $response->assertRedirect('/');

        $rest_time = RestTime::where('work_time_id', $work_time->id)->first();

        $this->assertSame($work_time->id, $rest_time->work_time_id);
        $this->assertNotNull($work_time->work_start);
    }
    public function testEnd()
    {
        $today = Carbon::today()->format('Y-m-d');
        $user = User::factory()->create();
        $work_time = WorkTime::factory()->create([
            'user_id' => $user->id,
            'date' => $today,
        ]);

        $response = $this->actingAs($user)->post('rest-start');
        
        $rest_time = RestTime::where('work_time_id', $work_time->id)->first();

        $this->assertNull($rest_time->rest_end);

        $response = $this->actingAs($user)->post('rest-end');
        
        $rest_time = RestTime::where('work_time_id', $work_time->id)->first();

        $this->assertNotNull($rest_time->rest_end);
    }
}