<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use App\Models\RestTime;
use Auth;

class RestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStart()
    {
        $user = User::factory()->create();
        WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);
        $work_time = WorkTime::where('user_id', $user->id)->where('date', '2022-06-19')->first();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/rest-start');
        $response->assertRedirect('/');

        RestTime::factory()->create([
            'work_time_id' => $work_time->id,
        ]);
        $this->assertDatabaseHas('rest_times',[
            'work_time_id' => $work_time->id,
            'rest_start'=>'14:53:55',
        ]);
    }
    public function testEnd()
    {
        $user = User::factory()->create();
        WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);
        $work_time = WorkTime::where('user_id', $user->id)->where('date', '2022-06-19')->first();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/rest-end');
        $response->assertRedirect('/');

        RestTime::factory()->create([
            'work_time_id' => $work_time->id,
        ]);

        RestTime::where('work_time_id', $work_time->id)->latest()->first()->update([
            'rest_end' => '14:53:55',
        ]);
        $this->assertDatabaseHas('rest_times', [
            'rest_end' => '14:53:55',
        ]);
    }
}