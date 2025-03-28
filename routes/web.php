<?php

use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\PropertyAgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

// =======================
// ✅ AUTHENTICATION ROUTES
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// =====================
// ✅ DASHBOARD ROUTES
// =====================
Route::middleware(['auth', CheckRole::class . ':3'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', CheckRole::class . ':2'])->group(function () {
    Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
    Route::get('/profile/agent/edit', [AgentDashboardController::class, 'edit'])->name('profile.agent.edit');
    Route::match(['put', 'patch'], '/profile/agent/update', [AgentDashboardController::class, 'update'])->name('profile.agent.update');
    Route::delete('/properties/{id}', [AgentDashboardController::class, 'destroy'])->name('propertiesbyagent.destroy');
});

// =================
// ✅ PROFILE ROUTES
// =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ===================
// ✅ STATIC PAGES
// ===================
Route::get('/', [PageController::class, 'main'])->name('main');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/property_listing', [PageController::class, 'property_list'])->name('property_list');
Route::get('/property_types', [PageController::class, 'property_type'])->name('property_type');
Route::get('/property_agents', [PageController::class, 'property_agent'])->name('property_agent');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// =======================
// ✅ PROPERTY ROUTES
// =======================
Route::resource('properties', PropertyController::class);
Route::get('/property-types', [PropertyTypeController::class, 'index'])->name('property_types.index');
Route::get('/property-agents', [PropertyAgentController::class, 'index'])->name('property_agents.index');
