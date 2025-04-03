<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PageController extends Controller
{
    public function main()
    {
        $properties = Property::all(); // Barcha mulklarni olish
        return view('main', compact('properties')); // Blade faylga yuborish
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
