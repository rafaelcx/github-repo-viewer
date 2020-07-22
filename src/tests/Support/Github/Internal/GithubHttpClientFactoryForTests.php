<?php

namespace Tests\Support\Github\Internal;

use App\Github\Internal\GithubHttpClient;
use App\Github\Internal\GithubHttpClientFactory;

class GithubHttpClientFactoryForTests extends GithubHttpClientFactory
{

    public static function overrideClient(GithubHttpClient $http_client) {
        self::$override = $http_client;
    }

    public static function resetClient(): void {
        self::$override = null;
    }

}
