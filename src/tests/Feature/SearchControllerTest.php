<?php

namespace Tests\Feature;

use App\Github\GithubRepo;
use App\Repository;
use App\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\Github\Helper\MockResponseHelper;
use Tests\Support\Github\Internal\GithubHttpClientFactoryForTests;
use Tests\Support\Github\Internal\GithubHttpClientForTests;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testHomeController_Index() {
        $client = new GithubHttpClientForTests();

        $mock_response = MockResponseHelper::getMockSuccessfulResponseWithData(
            $name = 'Tetris',
            $full_name = 'dtrupenn/Tetris',
            $owner_login = 'dtrupenn',
            $html_url = 'https://github.com/dtrupenn/Tetris',
            $description = 'A C implementation of Tetris using Pennsim through LC4',
            $stargazers_count = 1,
            $language = 'assembly'
        );

        $client->pushMockResponse(new Response(200, [], $mock_response));
        GithubHttpClientFactoryForTests::overrideClient($client);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/search');

        $this->assertDatabaseCount(Repository::TABLE_NAME, 1);

        $expected_info_at_view = new GithubRepo($name, $full_name, $owner_login, $html_url, $description, $stargazers_count, $language);
        $response->assertViewHas('repo_info_list', [$expected_info_at_view]);
    }

    public function testHomeControllerWhileNotAuthenticated_ShouldRedirectToLogin() {
        $response = $this->get('/search');
        $response->assertRedirect('/login');
    }

    public function testHomeControllerWhileAuthenticated_ShouldGetHome() {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/search');
        $response->assertStatus(200);
    }

    public function tearDown(): void {
        parent::tearDown();
        GithubHttpClientFactoryForTests::resetClient();
    }

}
