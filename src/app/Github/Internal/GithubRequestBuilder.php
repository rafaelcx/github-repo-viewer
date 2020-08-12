<?php

namespace App\Github\Internal;

use GuzzleHttp\Psr7\Request;

class GithubRequestBuilder
{

    private const METHOD = 'GET';
    private const URI = 'https://api.github.com/search/repositories';


    public static function build(string $uri_query): Request {
        $uri = self::URI . $uri_query;
        return new Request(self::METHOD, $uri, self::getHeaders());
    }

    private static function getHeaders(): array {
        return [
            'Accept' => 'application/vnd.github.v3+json',
        ];
    }

}
