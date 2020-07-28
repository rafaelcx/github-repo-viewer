<?php

namespace App\Github;

class GithubRepo
{

    private $name;
    private $full_name;
    private $owner_login;
    private $html_url;
    private $description;
    private $stargazers_count;
    private $language;

    public function __construct(
        string $name,
        string $full_name,
        string $owner_login,
        string $html_url,
        string $description,
        int $stargazers_count,
        string $language)
    {
        $this->name = $name;
        $this->full_name = $full_name;
        $this->owner_login = $owner_login;
        $this->html_url = $html_url;
        $this->description = $description;
        $this->stargazers_count = $stargazers_count;
        $this->language = $language;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFullName(): string {
        return $this->full_name;
    }

    public function getOwnerLogin(): string {
        return $this->owner_login;
    }

    public function getHtmlUrl(): string {
        return $this->html_url;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStargazersCount(): int {
        return $this->stargazers_count;
    }

    public function getLanguage(): string {
        return $this->language;
    }

}
