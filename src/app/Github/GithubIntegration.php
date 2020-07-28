<?php

namespace App\Github;

use App\Github\Internal\GithubHttpClientFactory;
use App\Github\Internal\GithubRequestBuilder;
use App\Github\Internal\GithubResponseParser;

class GithubIntegration
{

    public function fetchAll(): array {
        $request = GithubRequestBuilder::build();
        $client = GithubHttpClientFactory::create();
        $response = $client->makeHttpRequest($request);
        return GithubResponseParser::parse($response);
    }

}
