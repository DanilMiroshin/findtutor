<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function register_returns_form_view()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function register_returns_validation_error()
    {
        $response = $this->post('register', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['first_name', 'email', 'password']);
    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {
        $first_name = 'John';
        $last_name = 'Doe';
        $email = 'Johndoe@mail.com';
        $age = 15;
        $password = 'password';

        $response = $this->post('register', [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'age' => $age,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect('/');

        $user = User::where('email', $email)->where('first_name', $first_name)->first();
        $this->assertNotNull($user);

        $this->assertAuthenticatedAs($user);
    }
}
