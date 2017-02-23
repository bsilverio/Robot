<?php

namespace Tests\Uni;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserClassTest extends TestCase
{

    protected $user;
    protected $password;
    protected $hashedPassword;

    public function setUp() {
        parent::setUp();

        $this->user = new User();
        $this->user->first_name = "benjamin joseph";
        $this->user->last_name = "silverio";
        $this->user->email = "benjosilverio@gmail.com";
        $this->user->password = "password";
        $this->user->save();
    }

    /**
     * A test for api login.
     *
     * @return void
     */
    public function testRegisterAccount()
    {
        $response = $this->post('/register', [
            'username' => 'benjosilverio@gmail.com',
            'password' => 'password'
        ]);



    }

}
