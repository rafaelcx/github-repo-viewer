<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagesControllerTest extends TestCase
{

    public function testPagesController_Index() {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'tittle' => 'Github Repo Finder',
            'paragraph' => 'This could be a brief explanation about the application',
        ]);
    }

    public function testPagesController_Details() {
        $response = $this->get('/details');

        $response->assertStatus(200);
        $response->assertViewHas('tittle', 'Main Features');
        $response->assertViewHas('features', [
            'repo_finder' => 'Find the most popular Github repositories by language',
            'login' => 'Login into the platform',
            'register' => 'Register into the platform under a username and password',
        ]);
    }

    public function testPagesController_About() {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertViewHasAll([
            'tittle' => 'About',
            'paragraph' => 'This is the about information for the application',
        ]);
    }

}
