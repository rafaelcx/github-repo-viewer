<?php

namespace App\Github;

use App\Github\Internal\GithubHttpClientFactory;
use App\Github\Internal\GithubRequestBuilder;
use App\Github\Internal\GithubResponseParser;
use GuzzleHttp\Psr7\Response;

class GithubIntegration
{

    private function fetch(string $uri_query): Response {
        $request = GithubRequestBuilder::build($uri_query);
        $client = GithubHttpClientFactory::create();
        return $client->makeHttpRequest($request);
    }

    public function fetchAll(): array {
        $uri_query = '?q=language:php+language:javascript+language:python&sort=stars';
        $response = $this->fetch($uri_query);
        return GithubResponseParser::parse($response);
    }

    public function fetchWithQuery(string $query): array {
        if (empty($query)) {
            return $this->fetchAll();
        }

        $uri_query = '?q=language:' . $query . '&sort=stars';
        $response = $this->fetch($uri_query);
        return GithubResponseParser::parse($response);
    }

}
