<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Unit Test Scenario
     */
    //Register:
    // 1. Berhasil Register
    // 2. Gagal Register
    // 3. Username telah dipakai
    // 4. Name empty

    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'username' => 'test',
            'password' => 'test',
            'name' => 'test',
        ])->assertStatus(201) #harapannya
        ->assertJson([
            'data' => [
                "username" => "test",
                "name" => "test",
            ],
        ]);
    }

    public function testRegisterFailed(){
        $this->post('/api/users', [
            'username' => '',
            'password' => '',
            'name' => '',
        ])->assertStatus(400) #harapannya
        ->assertJson([
            'errors' => [
                "username" => [
                    "The username field is required."
                ],
                "password" => [
                    "The password field is required."
                ],
                "name" => [
                    "The name field is required."
                ]
            ]
        ]);
    }

    public function testRegisterAlreadyExists()
    {
        $this->testRegisterSuccess();
        $this->post('/api/users', [
            'username' => 'test',
            'password' => 'test',
            'name' => 'test',
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    "username" => [
                        "The username already exists."
                    ]
                ]
            ]);
    }
}
