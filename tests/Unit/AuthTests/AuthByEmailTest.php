<?php

namespace Tests\Unit\AuthTests;

use Tests\TestCase;
use App\Users\Models\User;
use App\Auth\Actions\AuthByEmailAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthByEmailTest extends TestCase
{
    use RefreshDatabase;

    private array $credential = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->credential = ['password' => fake()->password, 'email' => fake()->email];
        User::factory()->create($this->credential);
    }

    public function testAuthByEmail()
    {
        /**
         * @var AuthByEmailAction $action
         */
        $action = app()->make(AuthByEmailAction::class);

        $this->assertTrue($action->execute($this->credential));
    }

    public function testAuthByEmailWrongData()
    {
        /**
         * @var AuthByEmailAction $action
         */
        $action = app()->make(AuthByEmailAction::class);

        $this->assertFalse($action->execute(['password' => fake()->password, 'email' => fake()->email]));
    }
}
