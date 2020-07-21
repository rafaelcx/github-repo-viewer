<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Repository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testHomeController_Index() {
        $user = factory(User::class)->create();

        $repository_one_data = [
            'name' => 'Repository Name One',
            'full_name' => 'author/RepositoryName',
            'owner_login' => 'owner_login',
            'html_url' => 'https://github.com/author/repo_one',
            'description' => 'Test description one',
            'stargazers_count' => 20,
            'language' => 'php',
        ];

        $repository_two_data = [
            'name' => 'Repository Name Two',
            'full_name' => 'author/RepositoryName',
            'owner_login' => 'owner_login',
            'html_url' => 'https://github.com/author/repo_two',
            'description' => 'Test description two',
            'stargazers_count' => 10,
            'language' => 'java',
        ];

        factory(Repository::class)->create($repository_one_data);
        factory(Repository::class)->create($repository_two_data);

        $response = $this->actingAs($user)->get('/home');

        $response->assertViewHas('repo_info_list', Repository::all());
    }

    public function testHomeControllerWhileNotAuthenticated_ShouldRedirectToLogin() {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    public function testHomeControllerWhileAuthenticated_ShouldGetHome() {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
    }

}
