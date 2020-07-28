<?php

namespace Tests\Github\Internal;

use App\Github\Internal\GithubRequestBuilder;
use PHPUnit\Framework\TestCase;

class GithubRequestBuilderTest extends TestCase
{

    public function testGithubRequestBuilder() {
        $request = GithubRequestBuilder::build();

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('https://api.github.com/search/repositories', $request->getUri());
        $this->assertEquals(['application/vnd.github.v3+json'], $request->getHeader('Accept'));
        $this->assertEmpty((string) $request->getBody());
    }

}
