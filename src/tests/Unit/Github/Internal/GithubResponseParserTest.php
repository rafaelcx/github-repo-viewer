<?php

namespace Tests\Github\Internal;

use App\Github\Internal\GithubResponseParser;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Tests\Support\Github\Helper\MockResponseHelper;

class GithubResponseParserTest extends TestCase
{

    public function testGithubResponseParser() {
        $response_body = MockResponseHelper::getMockSuccessfulResponseBodyWithData(
            $name = 'Tetris',
            $full_name = 'dtrupenn/Tetris',
            $owner_login = 'dtrupenn',
            $html_url = 'https://github.com/dtrupenn/Tetris',
            $description = 'A C implementation of Tetris',
            $stargazers_count = 1,
            $language = 'Assembly'
        );
        $response = new Response(200, [], $response_body);

        $parsed_response = GithubResponseParser::parse($response);
        $this->assertEquals($name,             $parsed_response[0]->getName());
        $this->assertEquals($full_name,        $parsed_response[0]->getFullName());
        $this->assertEquals($owner_login,      $parsed_response[0]->getOwnerLogin());
        $this->assertEquals($html_url,         $parsed_response[0]->getHtmlUrl());
        $this->assertEquals($description,      $parsed_response[0]->getDescription());
        $this->assertEquals($stargazers_count, $parsed_response[0]->getStargazersCount());
        $this->assertEquals($language,         $parsed_response[0]->getLanguage());
    }

    public function unsuccessfulHttpStatusCodeProvider(): iterable {
        yield [404];
        yield [500];
    }

    /** @dataProvider unsuccessfulHttpStatusCodeProvider */
    public function testGithubResponseParser_WhenRequestIsUnsuccessful(int $http_status_code) {
        $response = new Response($http_status_code, [], '');
        $parsed_response = GithubResponseParser::parse($response);
        $this->assertEmpty($parsed_response);
    }

}
