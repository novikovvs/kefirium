<?php

namespace Tests\Unit\AuthTests;

use Tests\TestCase;
use App\Auth\Actions\RegisterByEmailAction;
use App\Auth\Factories\RegisterByEmailFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterByEmailTest extends TestCase
{
    use RefreshDatabase;

    private array $registerData = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->registerData = [
            'email'    => fake()->email,
            'password' => fake()->password,
            'name'     => fake()->name,
        ];
    }

    public function testRegisterByEmail()
    {
        /**
         * @var RegisterByEmailAction $action
         */
        $action = $this->app->make(RegisterByEmailAction::class);

        $DTO = RegisterByEmailFactory::fromArray($this->registerData);

        $this->assertEquals($DTO->name, $this->registerData['name']);
        $this->assertEquals($DTO->email, $this->registerData['email']);
        $this->assertEquals($DTO->password, $this->registerData['password']);

        $this->assertNotEmpty($action->execute($DTO));
    }
}
