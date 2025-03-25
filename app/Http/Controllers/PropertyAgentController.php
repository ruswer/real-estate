<?php

namespace App\Http\Controllers;

use App\Models\PropertyAgent;
use Illuminate\Http\Request;

class PropertyAgentController extends Controller
{
    public function index()
    {
        $agents = PropertyAgent::all();
        return view('property_agents.index', compact('agents'));
    }
}
