<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\services\InspiringService;
use App\Http\Controllers\InspiringController;
use Tests\TestCase;

class InspireTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/inspire');
        $response->assertStatus(200);

        // mock
        $mock = \Mockery::mock(InspiringService::class);
        $mock->shouldReceive('inspire')->andReturn('名言');
        $inspireController = new InspiringController($mock);
        self::assertEquals('名言', $inspireController->inspire());
    }
}
