<?php

namespace Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    public function testLogoutControllerSuccessfully()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/logout');

        $response->assertSuccessful();
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
