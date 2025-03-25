<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyAgent;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $agent = PropertyAgent::where('user_id', $user->id)->first();

        if (!$agent) {
            return redirect()->route('home')->with('error', 'Siz agent emassiz.');
        }

        // "property_agent_id" ustuni bo‘yicha qidiramiz
        $properties = Property::where('property_agent_id', $agent->id)->get();
        $activeProperties = Property::where('property_agent_id', $agent->id)->where('status', 'active')->get();
        $pendingProperties = Property::where('property_agent_id', $agent->id)->where('status', 'pending')->get();
        $rejectedProperties = Property::where('property_agent_id', $agent->id)->where('status', 'rejected')->get();

        return view('dashboard.agent', compact('agent', 'properties', 'activeProperties', 'pendingProperties', 'rejectedProperties'));
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('agent.dashboard')->with('success', 'Mulk muvaffaqiyatli o‘chirildi!');
    }
}
