<?php

namespace App\Github\Internal;

use GuzzleHttp\Psr7\Response;

class GithubResponseParser
{

    public static function parse(Response $response): array {
        if ($response->getStatusCode() === 200) {
            $response_body = (string) $response->getBody();
            $parsed_response_body = json_decode($response_body);

            $repository_list = $parsed_response_body->items;

            $parsed_repository_list = [];
            foreach ($repository_list as $repository) {
                array_push($parsed_repository_list, $repository->name);
            }

            return $parsed_repository_list;
        }

        return [];
    }

}
