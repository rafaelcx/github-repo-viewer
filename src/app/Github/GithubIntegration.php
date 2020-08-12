<?php

namespace App\Github;

use App\Github\Internal\GithubHttpClientFactory;
use App\Github\Internal\GithubRequestBuilder;
use App\Github\Internal\GithubResponseParser;

class GithubIntegration
{

    public function fetchAll(): array {
        $uri_query = '?q=language:php+language:javascript+language:python&sort=stars';
        $request = GithubRequestBuilder::build($uri_query);
        $client = GithubHttpClientFactory::create();
        $response = $client->makeHttpRequest($request);
        return GithubResponseParser::parse($response);
    }

}
