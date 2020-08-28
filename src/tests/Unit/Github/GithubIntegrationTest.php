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
        $mock_response = new Response(200, [], MockResponseHelper::getMockSuccessfulResponseBody());
        $client->pushMockResponse($mock_response);

        GithubHttpClientFactoryForTests::overrideClient($client);

        $integration = new GithubIntegration();
        $repo_list = $integration->fetchAll();

        $this->assertEquals('Tetris',                                                 $repo_list[0]->getName());
        $this->assertEquals('dtrupenn/Tetris',                                        $repo_list[0]->getFullName());
        $this->assertEquals('dtrupenn',                                               $repo_list[0]->getOwnerLogin());
        $this->assertEquals('https://github.com/dtrupenn/Tetris',                     $repo_list[0]->getHtmlUrl());
        $this->assertEquals('A C implementation of Tetris using Pennsim through LC4', $repo_list[0]->getDescription());
        $this->assertEquals(1,                                                        $repo_list[0]->getStargazersCount());
        $this->assertEquals('Assembly',                                               $repo_list[0]->getLanguage());
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
