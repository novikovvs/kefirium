<?php

namespace Tests\Feature\GoogleTests;

use Mockery;
use Tests\TestCase;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GoogleCallbackTest extends TestCase
{
    use RefreshDatabase;

    protected string $userName = '';

    protected string $userEmail = '';

    protected string $userGoogleId = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->userName = fake()->name;
        $this->userEmail = fake()->email;
        $this->userGoogleId = fake()->uuid;

        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser
            ->shouldReceive('getId')
            ->andReturn($this->userGoogleId)
            ->shouldReceive('getName')
            ->andReturn($this->userName)
            ->shouldReceive('getEmail')
            ->andReturn($this->userEmail);
        Socialite::shouldReceive('driver->user')->andReturn($abstractUser);
        Socialite::shouldReceive('driver->stateless')->andReturnSelf();
    }

    public function testGoogleCallback()
    {
        $this->get(
            '/api/auth/google/callback'
        )->assertStatus(302);

        $result = $this->get('/api/me')->json('result');

        $this->assertEquals($result['name'], $this->userName);
        $this->assertEquals($result['email'], $this->userEmail);
        $this->assertEquals($result['google_id'], $this->userGoogleId);
    }
}
