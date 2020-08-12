<?php

namespace App\Http\Controllers;

use App\Github\GithubIntegration;
use App\Github\GithubRepo;
use App\Repository;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $github_integration = new GithubIntegration();
        $repo_info_list = $github_integration->fetchAll();

        /** @var GithubRepo $repo_info */
        foreach ($repo_info_list as $repo_info) {
            $repository_model = new Repository;
            $repository_model->setAttribute('name', $repo_info->getName());
            $repository_model->setAttribute('full_name', $repo_info->getFullName());
            $repository_model->setAttribute('owner_login', $repo_info->getOwnerLogin());
            $repository_model->setAttribute('html_url', $repo_info->getHtmlUrl());
            $repository_model->setAttribute('description', $repo_info->getDescription());
            $repository_model->setAttribute('stargazers_count', $repo_info->getStargazersCount());
            $repository_model->setAttribute('language', $repo_info->getLanguage());
            $repository_model->save();
        }

        return view('search.search')->with('repo_info_list', $repo_info_list);
    }

}
