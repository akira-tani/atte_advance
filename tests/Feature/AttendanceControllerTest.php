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
        $this->assertTrue(true);
        $response = $this->get('/attendance');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/attendance');
        $response->assertStatus(200);

        $work_time = WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);
        $date = '2022-06-19';
        $this->assertSame($work_time->date, $date);
    }

    public function testChangeDate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/attendance');
        $response->assertStatus(200);

        $carbon = new Carbon('2022-06-19');
        $calculate_date = $carbon->subDays(1);
        $date = $calculate_date->format("Y-m-d");
        $this->assertSame($date, '2022-06-18');

        $carbon = new Carbon('2022-06-19');
        $calculate_date = $carbon->addDays(1);
        $date = $calculate_date->format("Y-m-d");
        $this->assertSame($date, '2022-06-20');
    }

    public function testGetUser()
    {
        $this->assertTrue(true);
        $user = User::factory()->create([
            'name' => 'テスト太郎',
        ]);
        $response = $this->actingAs($user)->get('/attendance');
        $response->assertStatus(200);


        $response = User::find($user->id);
        $this->assertSame('テスト太郎', $response['name']);
    }
}