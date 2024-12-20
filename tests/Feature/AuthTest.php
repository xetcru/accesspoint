<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    // Тест на успешную регистрацию
    public function test_registration_with_valid_data()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Password123', 
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['token']); 

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);
    }

    // Тест на регистрацию с некорректным email
    public function test_registration_with_invalid_email()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'Password123',
        ]);

        $response->assertStatus(400)
                 ->assertJsonValidationErrors(['email']);
    }

    // Тест на регистрацию с слабым паролем
    public function test_registration_with_weak_password()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123', // Слабый пароль
        ]);

        $response->assertStatus(400)
                 ->assertJsonValidationErrors(['password']);
    }
}