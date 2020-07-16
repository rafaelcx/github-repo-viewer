<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $tittle = 'Index';
        $paragraph = 'This is the index for the application';

        return view('pages.index')->with([
            'tittle' => $tittle,
            'paragraph' => $paragraph,
        ]);
    }

    public function details() {
        $tittle = 'Details';
        $paragraph = 'This is the repo details fetched from github';

        return view('pages.details')->with([
            'tittle' => $tittle,
            'paragraph' => $paragraph,
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
