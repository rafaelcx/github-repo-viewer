<?php

namespace Tests\Github\Internal;

use App\Github\Internal\GithubResponseParser;
use GuzzleHttp\Psr7\Response;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use Tests\Support\Github\Helper\MockResponseHelper;

class GithubResponseParserTest extends TestCase
{

    public function testGithubResponseParser() {
        $repo_name = 'Tetris';
        $response = new Response(200, [], MockResponseHelper::getMockResponseWithData($repo_name));

        $parsed_response = GithubResponseParser::parse($response);

        $expected_parsed_response = [
            'Tetris',
        ];
        $this->assertEquals($expected_parsed_response, $parsed_response);
    }

}
