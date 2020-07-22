<?php

namespace App\Github\Internal;

class GithubHttpClientFactory
{
    protected static $override;

    public static function create(): GithubHttpClient {
        if (isset(self::$override)) {
            return self::$override;
        }

        return new GithubHttpClient();
    }

}
