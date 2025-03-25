<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main()
    {
        return view('main');
    }
    public function about()
    {
        return view('about');
    }
    public function property_list()
    {
        return view('property-pages.property-list');
    }
    public function property_type()
    {
        return view('property-pages.property-type');
    }
    public function property_agent()
    {
        return view('property-pages.property-agent');
    }
    public function contact()
    {
        return view('contact');
    }
}
