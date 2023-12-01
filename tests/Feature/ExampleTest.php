<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test for a specific functionality.
     *
     * @return void
     */
    public function testSpecificFunctionality()
    {
        // Your test logic here
        $result = true;

        $this->assertTrue($result);
    }
}