<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyAgent;
use App\Models\AgentContact;

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

        // Agentga yuborilgan barcha kontaktlarni olish
        $contacts = AgentContact::latest()->get();

        return view('dashboard.agent', compact('agent', 'properties', 'activeProperties', 'pendingProperties', 'rejectedProperties', 'contacts'));
    }

    public function edit()
    {
        $user = Auth::user(); // Joriy foydalanuvchini olish
        $agent = PropertyAgent::where('user_id', $user->id)->firstOrFail(); // Foydalanuvchiga tegishli agentni olish
        return view('profile.agent.edit', compact('agent'));
    }

    public function update(Request $request)
    {
        $agent = Auth::user();
        
        // ✅ Validatsiya
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'image' => 'nullable|image|max:2048', // Maksimal 2MB rasm
        ]);

        // Ma'lumotlarni yangilash
        $agent = PropertyAgent::where('user_id', auth()->id())->firstOrFail();
    
        $agent->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
        ]);

        // ✅ Rasm yuklash
        if ($request->hasFile('image')) {
            // Eski rasmni o‘chirish
            if ($agent->image && Storage::exists($agent->image->path)) {
                Storage::delete($agent->image->path);
            }

            // Yangi rasmni saqlash
            $path = $request->file('image')->store('agents', 'public');
            $agent->image()->updateOrCreate([], ['path' => $path]);
        }

        $agent->save();

        return redirect()->route('agent.dashboard')->with('success', 'Profil muvaffaqiyatli yangilandi.');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('agent.dashboard')->with('success', 'Mulk muvaffaqiyatli o‘chirildi!');
    }
}
