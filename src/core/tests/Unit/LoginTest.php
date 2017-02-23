<?php

namespace Tests\Uni;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    public function setUp() {
        parent::setUp();
    }

    /**
     * A test for api login.
     *
     * @return void
     */
    public function testValidAccount()
    {
        $response = $this->post('/login', [
            'email' => 'benjosilverio@gmail.com',
            'password' => 'password'
        ]);

        $response
            ->assertJson([
                'success' => 1
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'response' => [
                'token','user' =>
                        ['email','first_name','last_name','id']
                ]
            ]);
    }

    /**
     * A test for api login.
     *
     * @return void
     */
    public function testInvalidAccount()
    {
        $response = $this->post('/login', [
            'email' => 'benjosilverio@gmail.com',
            'password' => 'passwor'
        ]);


        $response
            ->assertStatus(401)
            ->assertExactJson([
                'success' => 0,
                'error' => "These credentials do not match our records."
            ]);
    }

}
