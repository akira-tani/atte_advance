<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;

class AttendanceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $date = Carbon::today()->format("Y-m-d");
        $response = $this->get('/attendance');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $work_time = WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/attendance');
        $response->assertStatus(200);
        $response->assertViewIs('attendance');
        $response->assertViewHas('date', $date);
        $response->assertViewHas('work_times');
    }

    public function testChangeDate()
    {
        $user = User::factory()->create();
        $carbon = Carbon::today();

        $response = $this->actingAs($user)->post('attendance', [
            'change_date' => 'back',
        ]);
        $calculate_date = $carbon->subDays(1);
        $date = $calculate_date->format("Y-m-d");
        $response->assertStatus(200);
        $response->assertViewIs('attendance');
        $response->assertViewHas('date', $date);
        $response->assertViewHas('work_times');
    }

    public function testGetUser()
    {
        $user = User::factory()->create();
        $work_time = WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('user_attendance');
        $response->assertStatus(200);
        $response->assertViewIs('user_attendance');
    }
}