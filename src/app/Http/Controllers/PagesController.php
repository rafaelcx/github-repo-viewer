<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $tittle = 'Github Repo Finder';
        $paragraph = 'This could be a brief explanation about the application';

        return view('pages.index')->with([
            'tittle' => $tittle,
            'paragraph' => $paragraph,
        ]);
    }

    public function details() {
        $tittle = 'Main Features';
        $features = [
            'repo_finder' => 'Find the most popular Github repositories by language',
            'login' => 'Login into the platform',
            'register' => 'Register into the platform under a username and password',
        ];

        return view('pages.details')->with([
            'tittle' => $tittle,
            'features' => $features,
        ]);
    }

    public function about() {
        $tittle = 'About';
        $paragraph = 'This is the about information for the application';

        return view('pages.about')->with([
            'tittle' => $tittle,
            'paragraph' => $paragraph,
        ]);
    }

}
