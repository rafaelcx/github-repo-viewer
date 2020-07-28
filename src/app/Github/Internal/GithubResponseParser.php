<?php

namespace App\Github\Internal;

use App\Github\GithubRepo;
use GuzzleHttp\Psr7\Response;

class GithubResponseParser
{

    public static function parse(Response $response): array {
        if ($response->getStatusCode() === 200) {
            return self::handleSuccessfulResponse($response);
        }
        return [];
    }

    private static function handleSuccessfulResponse(Response $response): array {
        $response_body = (string) $response->getBody();
        $parsed_response_body = json_decode($response_body);

        $repository_list_from_request = $parsed_response_body->items;

        $parsed_repository_list = [];
        foreach ($repository_list_from_request as $repository_from_request) {
            $github_repo = self::getGithubRepoFromRequest($repository_from_request);
            array_push($parsed_repository_list, $github_repo);
        }

        return $parsed_repository_list;
    }

    private function getGithubRepoFromRequest(\stdClass $repository_from_request): GithubRepo {
        return new GithubRepo(
            $repository_from_request->name ?? '',
            $repository_from_request->full_name ?? '',
            $repository_from_request->owner->login ?? '',
            $repository_from_request->html_url ?? '',
            $repository_from_request->description ?? '',
            $repository_from_request->stargazers_count ?? 0,
            $repository_from_request->language ?? ''
        );
    }

}
