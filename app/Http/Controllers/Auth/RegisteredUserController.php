<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PropertyAgent;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'role_id' => ['required', 'in:2,3'], // 2 - Agent, 3 - User
            'designation' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],

        ]);

        // 🔹 **User yaratish**
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // 🔹 **Agent yaratish**
        if ($request->role_id == 2) {
            $agent = PropertyAgent::create([
                'user_id' => $user->id,
                'name' => $request->first_name . ' ' . $request->last_name,
                'designation' => $request->designation,
                'facebook' => $request->facebook ?? null,
                'twitter' => $request->twitter ?? null,
                'instagram' => $request->instagram ?? null,
            ]);
        
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('agents', 'public');  // 'public' diskiga saqlash
                $image = new Photo(['path' => $imagePath]);  // Faylni modelga kiritish
                $agent->image()->save($image);  // Agentga rasmni bog'lash
            }          
        }
        
        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('main');
    }
}
