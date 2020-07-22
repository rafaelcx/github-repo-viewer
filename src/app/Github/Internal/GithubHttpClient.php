<?php

namespace App\Github\Internal;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class GithubHttpClient
{

    public function makeHttpRequest(Request $request): Response {
        $request_handler = $this->createRequestHandler();
        $client = new Client(['handler' => $request_handler]);

        try {
            $response = $client->send($request);
        } catch (\Exception $exception) {
            $response = new Response(500, [], 'Internal server error: ' . $exception->getMessage());
        }

        return $response;
    }

    protected function createRequestHandler(): HandlerStack {
        return HandlerStack::create();
    }

}
