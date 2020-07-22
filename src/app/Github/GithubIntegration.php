<?php

namespace App\Github;

use App\Github\Internal\GithubHttpClientFactory;
use GuzzleHttp\Psr7\Request;

class GithubIntegration
{
    public function fetchAll(): array {
        $method = 'GET';
        $uri = 'https://api.github.com/search/repositories';
        $headers = ['Accept' => 'application/vnd.github.v3+json'];

        $request = new Request($method, $uri, $headers);

        $client = GithubHttpClientFactory::create();
        $response = $client->makeHttpRequest($request);

        $response_body = (string) $response->getBody();
        $parsed_response_body = json_decode($response_body);

        $repository_list = $parsed_response_body->items;

        $parsed_repository_list = [];
        foreach ($repository_list as $repository) {
            array_push($parsed_repository_list, $repository->name);
        }

        return $parsed_repository_list;
    }

}
