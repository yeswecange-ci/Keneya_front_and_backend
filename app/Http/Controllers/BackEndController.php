<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BackEndController extends Controller
{
    public function index(Request $request)
{
    $cookiesAccepted = $request->cookie('cookies_accepted', false);

    return view('dashboard.index', compact('cookiesAccepted'));
}

    public function about(): View
    {
        return view('backend.about');
    }
    // public function accueil(): View
    // {
    //     return view('backend.accueil');
    // }
    public function contact(): View
    {
        return view('backend.contact');
    }
    public function activities(): View
    {
        return view('backend.activities');
    }
    public function actualities(): View
    {
        return view('backend.actualities');
    }
}
