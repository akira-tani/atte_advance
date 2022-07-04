<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Auth;

class AtteTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterDisplay()
    {
        $this->assertTrue(true);
        $response = $this->get('/register');
        $response->assertStatus(200);

    }
    public function testLoginDisplay()
    {
        $this->assertTrue(true);
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testUserCreate()
    {
        User::factory()->create([
            'name'=>'aaa',
            'email'=>'bbb@ccc.com',
            'password'=>'dddd',
        ]);
        $this->assertDatabaseHas('users',[
            'name'=>'aaa',
            'email'=>'bbb@ccc.com',
            'password'=>'dddd',
        ]);
    }
    public function testUserLogin()
    {
        $user = User::factory()->create();
        $this->assertFalse(Auth::check());
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'test1234',
        ]);
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/');
    }

    public function testUserLogout()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->assertTrue(Auth::check());
        $this->post('logout');
        $this->assertFalse(Auth::check());
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testStampDisplay()
    {
        $this->assertTrue(true);
        $response = $this->get('/');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }

    public function testUserDisplay()
    {
        $this->assertTrue(true);
        $response = $this->get('/user');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/user');
        $response->assertStatus(200);
    }

    public function testWorkStartStamp()
    {
        $user = User::factory()->create();

        WorkTime::factory()->create([
            'user_id' => $user->id,
            'date'=>'2022-06-19',
            'work_start'=>'14:53:55',
        ]);
        $this->assertDatabaseHas('work_times',[
            'user_id' => $user->id,
            'date'=>'2022-06-19',
            'work_start'=>'14:53:55',
        ]);
    }

    public function testWorkEndStamp()
    {
        $user = User::factory()->create();

        WorkTime::factory()->create([
            'user_id' => $user->id,
            'date'=>'2022-06-19',
            'work_start'=>'14:53:55',
        ]);
        $this->assertDatabaseHas('work_times',[
            'user_id' => $user->id,
            'date'=>'2022-06-19',
            'work_start'=>'14:53:55',
        ]);

        // WorkTime::where('user_id', $user->id)->where('date', '2022-06-19')->update([
        //     'work_end' => 
        // ])
    }
}
