<?php

namespace Tests\Unit\Github;

use App\Github\GithubIntegration;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tests\Support\Github\Helper\MockResponseHelper;
use Tests\Support\Github\Internal\GithubHttpClientFactoryForTests;
use Tests\Support\Github\Internal\GithubHttpClientForTests;

class GithubIntegrationTest extends TestCase
{

    public function testGithubIntegration_FetchAll() {
        $client = new GithubHttpClientForTests();
        $mock_response = new Response(200, [], MockResponseHelper::getMockResponseWithData($name = 'Tetris'));
        $client->pushMockResponse($mock_response);

        GithubHttpClientFactoryForTests::overrideClient($client);

        $integration = new GithubIntegration();
        $repo_list = $integration->fetchAll();

        $expected_result = [
            'Tetris',
        ];

        $this->assertEquals($expected_result, $repo_list);
    }

    public function testGithubIntegration_FetchAll_TimeOutScenario() {
        $client = new GithubHttpClientForTests();
        $client->pushMockConnectionTimeOutResponse(new Request($method = 'GET', $uri = 'https://uri.com/test'));
        GithubHttpClientFactoryForTests::overrideClient($client);

        $integration = new GithubIntegration();
        $repo_list = $integration->fetchAll();

        $this->assertEmpty($repo_list);
    }

    public function tearDown(): void {
        parent::tearDown();
        GithubHttpClientFactoryForTests::resetClient();
    }

}
