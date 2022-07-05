<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Auth;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $this->assertTrue(true);
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testStore()
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

}
