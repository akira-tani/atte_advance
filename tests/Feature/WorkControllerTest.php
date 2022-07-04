<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Auth;

class WorkControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStart()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/work-start');
        $response->assertRedirect('/');

        WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('work_times',[
            'user_id' => $user->id,
            'date'=>'2022-06-19',
            'work_start'=>'14:53:55',
        ]);
    }

    public function testEnd()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/work-end');
        $response->assertRedirect('/');

        WorkTime::factory()->create([
            'user_id' => $user->id,
        ]);

        WorkTime::where('user_id', $user->id)->where('date', '2022-06-19')->update([
            'work_end' => '14:53:55',
        ]);
        $this->assertDatabaseHas('work_times', [
            'work_end' => '14:53:55',
        ]);
    }
}
