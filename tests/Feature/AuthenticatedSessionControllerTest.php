<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Auth;

class AuthenticatedSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $this->assertTrue(true);
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testStore()
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

    public function testDestroy()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->assertTrue(Auth::check());
        $this->post('logout');
        $this->assertFalse(Auth::check());
        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
