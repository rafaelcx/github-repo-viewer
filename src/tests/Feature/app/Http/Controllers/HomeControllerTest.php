<?php

namespace Tests\Feature\app\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    use RefreshDatabase;

    public function testHomeController_Index() {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertViewHas('repo_info_list', [
            [
                'name' => 'Repository name',
                'full_name' => 'author/RepositoryName',
                'owner_login' => 'owner_login',
                'html_url' => 'https://github.com/rafaelcx/github-repo-viewer',
                'language' => 'php',
            ],
        ]);
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
