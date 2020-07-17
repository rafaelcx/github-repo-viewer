<?php

namespace Tests\Feature\routes;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic routing test. Add a desired route to the data provider.
     */

    public function routesProvider(): iterable {
        yield 'Request to "/" path'        => ['/',        200];
        yield 'Request to "/about" path'   => ['/about',   200];
        yield 'Request to "/details" path' => ['/details', 200];
    }

    /** @dataProvider routesProvider
     * @param string $route
     * @param int $expected_status_code
     */
    public function testBasicTest(string $route, int $expected_status_code) {
        $response = $this->get($route);
        $response->assertStatus($expected_status_code);
    }

}
