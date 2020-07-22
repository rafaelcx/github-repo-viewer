<?php

namespace Tests\Support\Github\Internal;

use App\Github\Internal\GithubHttpClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class GithubHttpClientForTests extends GithubHttpClient
{

    private $mock_responses = [];

    protected function createRequestHandler(): HandlerStack {
        $handler = parent::createRequestHandler();
        $handler->setHandler(new MockHandler($this->mock_responses));
        return $handler;
    }

    public function pushMockResponse(Response $response): void {
        array_push($this->mock_responses, $response);
    }

    public function pushMockConnectionTimeOutResponse(Request $request): void {
        $connection_exception = new ConnectException('Connection Timeout', $request);
        array_push($this->mock_responses, $connection_exception);
    }

}
