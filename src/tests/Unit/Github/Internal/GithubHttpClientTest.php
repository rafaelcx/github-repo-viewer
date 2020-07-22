<?php

namespace Tests\Unit\Github\Internal;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tests\Support\Github\Internal\GithubHttpClientForTests;

class GithubHttpClientTest extends TestCase
{

    public function testGithubHttpClient_SuccessfulRequest() {
        $client = new GithubHttpClientForTests();

        $expected_http_status_code = 200;
        $expected_request_body = 'Successful Request';
        $client->pushMockResponse(new Response($expected_http_status_code, [], $expected_request_body));

        $dummy_request = $this->buildDummyRequest();
        $response = $client->makeHttpRequest($dummy_request);

        $this->assertEquals($expected_http_status_code, $response->getStatusCode());
        $this->assertEquals($expected_request_body, (string) $response->getBody());
    }

    public function testGithubHttpClient_UnsuccessfulRequest() {
        $client = new GithubHttpClientForTests();

        $dummy_request = $this->buildDummyRequest();
        $client->pushMockConnectionTimeOutResponse($dummy_request);

        $response = $client->makeHttpRequest($dummy_request);

        $expected_http_status_code = 500;
        $expected_request_body = 'Internal server error';
        $this->assertEquals($expected_http_status_code, $response->getStatusCode());
        $this->assertStringContainsString($expected_request_body, (string) $response->getBody());
    }

    private function buildDummyRequest(): Request {
        return new Request('GET', 'https://uri.com/test');
    }

}
