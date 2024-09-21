<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $title = "Hello Welcome to my Home Page";
        return view('pages.index', compact('title'));
    }
    public function about()
    {
        $title = 'About my server about me';
        return view('pages.about')->with('title', $title);
    }
    public function service()
    {
        $array =  [
                'PHP Hypertext',
                'hypertext markup language',
                'cascade style sheet'
           
            ];
        return view('pages.service')->with('array', $array);
    }
}
