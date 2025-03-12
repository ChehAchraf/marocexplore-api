<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function can_register(): void
    {
        $user = User::factory()->create([
            'name'      => 'oussama',
            'email'     =>  'test@gmail.com',
            'passwddord'  =>  'test4578'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'ali@example.com'
        ]);
    }
}
