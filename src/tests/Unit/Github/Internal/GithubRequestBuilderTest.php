<?php

namespace Tests\Github\Internal;

use App\Github\Internal\GithubRequestBuilder;
use PHPUnit\Framework\TestCase;

class GithubRequestBuilderTest extends TestCase
{

    public function testGithubRequestBuilder() {
        $uri_path = '?q=testPath';
        $request = GithubRequestBuilder::build($uri_path);

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('https://api.github.com/search/repositories' . $uri_path, $request->getUri());
        $this->assertEquals(['application/vnd.github.v3+json'], $request->getHeader('Accept'));
        $this->assertEmpty((string) $request->getBody());
    }

}
