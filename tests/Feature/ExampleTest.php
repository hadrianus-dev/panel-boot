<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        it('has api\tronus\church page', function () {
            $response = $this->get('/api\tronus\church');
        
            $response->assertStatus(200);
        });
    }
}
