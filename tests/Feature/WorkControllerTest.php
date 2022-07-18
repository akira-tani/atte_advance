<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Auth;
use Carbon\Carbon;

class WorkControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStart()
    {
        $today = Carbon::today()->format('Y-m-d');
        $user = User::factory()->create();
        $work_time = WorkTime::where('user_id', $user->id)->first();

        $this->assertNull($work_time);

        $response = $this->actingAs($user)->post('/work-start');
        $response->assertRedirect('/');

        $work_time = WorkTime::where('user_id', $user->id)->first();

        $this->assertSame($user->id, $work_time->user_id);
        $this->assertSame($today, $work_time->date);
        $this->assertNotNull($work_time->work_start);
    }

    public function testEnd()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('work-start');
        $work_time = WorkTime::where('user_id', $user->id)->first();

        $this->assertNull($work_time->work_end);

        $response = $this->actingAs($user)->post('/work-end');
        $response->assertRedirect('/');

        $work_time = WorkTime::where('user_id', $user->id)->first();

        $this->assertNotNull($work_time->work_start);
    }
}
