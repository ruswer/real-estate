<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\PropertyAgent;
use App\Models\PropertyType;
use App\Models\PropertyImage;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('type')) {
            $query->where('property_type_id', $request->type);
        }

        if ($request->filled('location')) {
            $location = preg_replace('/\s+/', ' ', trim($request->location)); // Bo‘sh joy va yangi qatorlarni olib tashlash
            $query->whereRaw('TRIM(REPLACE(location, "\n", " ")) = ?', [$location]);
        }

        $properties = $query->paginate(10);
        $propertyTypes = PropertyType::all();
        $locations = Property::distinct()->pluck('location');

        return view('properties.index', compact('properties', 'propertyTypes', 'locations'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'status' => 'required',
            'property_type_id' => 'required',
            'property_agent_id' => 'required|exists:property_agents,id',
            'is_for_rent_or_sale' => 'required|in:rent,sale',
            'images' => 'nullable|array|max:5', // Maksimal 5 ta rasm yuklash mumkin
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Har bir rasm validatsiyasi
        ]);
    
        // 1️⃣ Property yaratish
        $property = Property::create([
            'user_id' => auth()->id(),
            'status' => $request->status,
            'property_type_id' => $request->property_type_id,
            'property_agent_id' => $request->property_agent_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'is_for_rent' => $request->is_for_rent_or_sale === 'rent',
            'is_for_sale' => $request->is_for_rent_or_sale === 'sale',
        ]);
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('properties', 'public'); // Rasmni saqlash
        
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imagePath
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Mulk muvaffaqiyatli qo‘shildi!');
    }

    public function show($id)
    {
        $property = Property::with('images')->findOrFail($id);
        $agent = PropertyAgent::where('id', $property->property_agent_id)->first(); // Agentni topish

        return view('properties.show', compact('property', 'agent')); // Ma'lumotlarni Blade'ga yuborish
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
{
    // Debugging uchun (agar kerak bo‘lsa, o‘chirib qo‘yishingiz mumkin)
    // dd(request()->all(), request()->file('images'));

    // Validatsiya
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'location' => 'required|string',
        'status' => 'required|string',
        'property_type_id' => 'required|exists:property_types,id',
        'property_agent_id' => 'required|exists:property_agents,id',
        'is_for_rent_or_sale' => 'required|in:rent,sale',
        'images' => 'nullable|array|max:5', // Maksimal 5 ta rasm yuklash mumkin
        'existing_images' => 'nullable|array', // Eski rasmlar
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Yangi rasmlar uchun
    ]);

    // ✅ Mulkni yangilash
    $property->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'location' => $request->location,
        'status' => $request->status,
        'property_type_id' => $request->property_type_id,
        'property_agent_id' => $request->property_agent_id,
        'is_for_rent' => $request->is_for_rent_or_sale == 'rent',
        'is_for_sale' => $request->is_for_rent_or_sale == 'sale'
    ]);

    // 🖼️ Eski rasmlarni boshqarish
    $existingImages = $request->input('existing_images', []); // Forma orqali kelgan eski rasmlar
    $currentImages = $property->images->pluck('image_path')->toArray(); // Hozirgi rasmlar

    // O‘chirilgan rasmlarni aniqlash va o‘chirish
    $imagesToDelete = array_diff($currentImages, $existingImages);
    foreach ($imagesToDelete as $imagePath) {
        // Bazadan o‘chirish
        PropertyImage::where('property_id', $property->id)
                     ->where('image_path', $imagePath)
                     ->delete();
        // Storage’dan o‘chirish
        Storage::disk('public')->delete($imagePath);
    }

    // 🖼️ Yangi rasmlarni yuklash
    if ($request->hasFile('images')) {
        // Joriy rasmlar sonini hisoblash
        $currentImageCount = count($existingImages);
        $maxImages = 5; // Maksimal rasm chegarasi
        $remainingSlots = $maxImages - $currentImageCount;

        // Agar yangi rasmlar soni chegaradan oshmasa, yuklash
        $newImages = array_slice($request->file('images'), 0, $remainingSlots);
        foreach ($newImages as $image) {
            $imagePath = $image->store('properties', 'public');
            PropertyImage::create([
                'property_id' => $property->id,
                'image_path' => $imagePath
            ]);
        }
    }

    return redirect()->route('agent.dashboard')->with('success', 'Mulk muvaffaqiyatli yangilandi!');
}

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
    }
}
