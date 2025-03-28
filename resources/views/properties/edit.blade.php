<x-layouts.app>
    <x-slot:title>Tahrirlash Paneli</x-slot:title>

    <div class="container">
        <h2>Mulkni tahrirlash</h2>

        <!-- Xatolik xabarlari -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Sarlavha</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $property->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Tavsif</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $property->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Narx</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $property->price) }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Manzil</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $property->location) }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- ✅ Holat (Status) Select Box -->
            <div class="mb-3">
                <label for="status" class="form-label">Holat</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>Mavjud</option>
                    <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sotilgan</option>
                    <option value="pending" {{ old('status', $property->status) == 'pending' ? 'selected' : '' }}>Kutilmoqda</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- ✅ Mulk turi Select Box -->
            <div class="mb-3">
                <label for="property_type_id" class="form-label">Mulk turi</label>
                <select name="property_type_id" class="form-control @error('property_type_id') is-invalid @enderror">
                    @foreach ($propertyTypes as $type)
                        <option value="{{ $type->id }}" {{ old('property_type_id', $property->property_type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('property_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="property_agent_id" value="{{ $property->agent->id ?? '' }}">

            <!-- ✅ Ijara yoki Sotuv -->
            <div class="mb-3">
                <label for="is_for_rent_or_sale" class="form-label">Ijaraga/Sotuvga</label>
                <select name="is_for_rent_or_sale" class="form-control @error('is_for_rent_or_sale') is-invalid @enderror">
                    <option value="rent" {{ old('is_for_rent_or_sale', $property->is_for_rent) ? 'selected' : '' }}>Ijara uchun</option>
                    <option value="sale" {{ old('is_for_rent_or_sale', $property->is_for_sale) ? 'selected' : '' }}>Sotuv uchun</option>
                </select>
                @error('is_for_rent_or_sale')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- 🖼️ Rasmlar yuklash -->
            <div class="mb-3">
                <label class="form-label">Mulk rasmlari</label>
                <div class="d-flex flex-wrap gap-3">
                    <div id="image-preview-container" class="d-flex flex-wrap gap-2">
                        <!-- ✅ Joriy yuklangan rasmlar -->
                        @foreach ($property->images as $image)
                            <div class="image-box position-relative" style="width: 120px; height: 120px;">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail w-100 h-100" style="object-fit: cover;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-image-one" data-image-id="{{ $image->id }}">×</button>
                                <input type="hidden" name="existing_images[]" value="{{ $image->image_path }}">
                            </div>
                        @endforeach
                    </div>

                    <!-- 📤 Add More Pics tugmasi -->
                    <div class="card text-center p-3 bg-light border border-danger" style="width: 120px; height: 120px;">
                        <input type="file" id="image-upload" name="images[]" accept="image/*" multiple hidden>
                        <label for="image-upload" class="d-flex flex-column align-items-center justify-content-center h-100 text-danger">
                            <span class="fs-3 fw-bold">+</span>
                            <span class="small">Add more pics</span>
                        </label>
                    </div>
                </div>
                @error('images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-danger">Bekor qilish</a>
                <button type="submit" class="btn btn-success">Tahrirlash</button>
            </div>

        </form>

        <hr>

    </div>
</x-layouts.app>
