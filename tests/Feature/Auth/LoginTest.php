<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;    
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /* test user login success with email, password */
    //route login with get
    protected function loginGetRoute()
    {
        return route('login');
    }

    //route login with post
    protected function loginPostRoute()
    {
        return route('login');
    }

    //route logout successfully
    protected function successfulLogoutRoute()
    {
        return '/';
    }

    //route logout
    protected function logoutRoute()
    {
        return route('logout');
    }
    //test user can login with correct credentials
    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);
        $response = $this->post($this->loginPostRoute(), [
            'username' => $user->username,
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user, $guard = null);   
    } 

    //test user can see login views
    public function testUserCanViewALoginForm()
    {
        $response = $this->get($this->loginGetRoute());
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    //test user can not login with incorrect password
    public function testUserCannotLoginWithIncorrectPassword()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('i-love-laravel'),
        ]);
        $response = $this->from('/login')->post($this->loginPostRoute(), [
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);
        $response->assertRedirect($this->loginGetRoute());
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    //test user can logout successful
    public function testUserCanLogout()
    {
        $this->be(factory(User::class)->create());
        $response = $this->post($this->logoutRoute());
        $response->assertRedirect($this->successfulLogoutRoute());
        $this->assertGuest();
    }

    //test remember me functionality
    public function testRememberMeFunctionality()
    {
        $user = factory(User::class)->create([
            'id' => random_int(1, 100),
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);
        $response = $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'username' => $user->username,
            'password' => $password,
            'remember' => 'on',
        ]);
        $user = $user->fresh();
        $response->assertRedirect('/');
        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));
        $this->assertAuthenticatedAs($user);
    }
}
