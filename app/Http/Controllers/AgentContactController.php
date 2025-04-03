<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentContact;

class AgentContactController extends Controller
{
    // Foydalanuvchi yuborgan ma'lumotlarni saqlash
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'property_id' => 'required|integer',
        ]);

        // Ma'lumotlarni saqlash
        AgentContact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'property_id' => $request->property_id,
        ]);

        return back()->with('success', 'Ma\'lumotlaringiz agentga yuborildi!');
    }

    // Agent uchun bildirishnomalarni ko'rsatish
    public function notifications()
    {
        $contacts = AgentContact::latest()->get(); // Barcha kontaktlarni olish
        return view('dashboard.agent', compact('contacts'));
    }
}
