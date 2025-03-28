<x-layouts.app>
    <x-slot:title>Profilni tahrirlash</x-slot:title>

    <div class="container">
        <h2 class="mb-4">Profilni tahrirlash</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.agent.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Ism -->
            <div class="mb-3">
                <label for="name" class="form-label">Ism</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $agent->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Lavozim -->
            <div class="mb-3">
                <label for="designation" class="form-label">Lavozim</label>
                <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" 
                    value="{{ old('designation', $agent->designation) }}">
                @error('designation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rasm yuklash -->
            <div class="mb-3">
                <label class="form-label">Profil rasmi</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . ($agent->image ? $agent->image->path : 'default-avatar.jpg')) }}" 
                        alt="Avatar" class="rounded-circle" width="100" height="100">
                </div>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Ijtimoiy tarmoqlar -->
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror" 
                    value="{{ old('facebook', $agent->facebook) }}">
                @error('facebook')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter</label>
                <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror" 
                    value="{{ old('twitter', $agent->twitter) }}">
                @error('twitter')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="url" name="instagram" class="form-control @error('instagram') is-invalid @enderror" 
                    value="{{ old('instagram', $agent->instagram) }}">
                @error('instagram')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tugmalar -->
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-danger">Bekor qilish</a>
                <button type="submit" class="btn btn-success">Saqlash</button>
            </div>
        </form>
    </div>
</x-layouts.app>
