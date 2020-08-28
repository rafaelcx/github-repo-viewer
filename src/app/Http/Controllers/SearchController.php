<?php

namespace App\Http\Controllers;

use App\Github\GithubIntegration;
use App\Github\GithubRepo;
use App\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $github_integration = new GithubIntegration();
        $repo_info_list = $github_integration->fetchAll();

        $this->multiInsertIgnoreRepositoryResource($repo_info_list);

        return view('search.search')->with('repo_info_list', $repo_info_list);
    }

    public function query(Request $request) {
        $search_query = $request->input('query') ?? '';
        $github_integration = new GithubIntegration();
        $repo_info_list = $github_integration->fetchWithQuery($search_query);

        $this->multiInsertIgnoreRepositoryResource($repo_info_list);

        return view('search.search')->with('repo_info_list', $repo_info_list);
    }

    private function multiInsertIgnoreRepositoryResource(array $repo_info_list): void {
        $multi_insert_params = [];

        /** @var GithubRepo $repo_info */
        foreach ($repo_info_list as $repo_info) {
            $insert_params = [
                'name'             => $repo_info->getName(),
                'full_name'        => $repo_info->getFullName(),
                'owner_login'      => $repo_info->getOwnerLogin(),
                'html_url'         => $repo_info->getHtmlUrl(),
                'description'      => $repo_info->getDescription(),
                'stargazers_count' => $repo_info->getStargazersCount(),
                'language'         => $repo_info->getLanguage(),
            ];
            array_push($multi_insert_params, $insert_params);
        }

        DB::table(Repository::TABLE_NAME)->insertOrIgnore($multi_insert_params);
    }

}
