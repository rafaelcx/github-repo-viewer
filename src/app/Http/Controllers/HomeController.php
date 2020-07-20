<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $repo_info_list = [
            [
                'name' => 'Repository name',
                'full_name' => 'author/RepositoryName',
                'owner_login' => 'owner_login',
                'html_url' => 'https://github.com/rafaelcx/github-repo-viewer',
                'language' => 'php',
            ],
        ];

        return view('home.home')->with([
            'repo_info_list' => $repo_info_list,
        ]);
    }

}
