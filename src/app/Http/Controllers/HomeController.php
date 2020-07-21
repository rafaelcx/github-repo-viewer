<?php

namespace App\Http\Controllers;

use App\Repository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $repo_info_list = Repository::all();
        return view('home.home')->with('repo_info_list', $repo_info_list);
    }

}
