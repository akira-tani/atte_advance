<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkTime;
use Auth;

class StampControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $this->assertTrue(true);
        $response = $this->get('/');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }
}
