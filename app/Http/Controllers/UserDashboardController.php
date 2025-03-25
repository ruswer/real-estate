<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Joriy foydalanuvchini olish
        if (!$user) {
            return redirect()->route('login'); // Agar foydalanuvchi login qilmagan bo‘lsa
        }
        return view('dashboard.user', compact('user'));
    }
}
