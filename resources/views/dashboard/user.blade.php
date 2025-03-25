<x-layouts.app>
    <x-slot:title>Foydalanuvchi Paneli</x-slot:title>

    <div class="container py-5">
        <div class="row">
            <!-- Profil rasmi va "Profile Picture" tugmasi chap tomonda -->
            <div class="col-md-4 text-center">
                <div class="card shadow-sm p-4">
                    <img src="{{ $user->profile_photo_url ?? asset('images/default-avatar.png') }}"
                        class="rounded-circle img-fluid" width="150" height="150"
                        style="object-fit: cover; border-radius: 50%;">
                    <div class="mt-3">
                        <button class="btn btn-outline-primary">Profile Picture</button>
                    </div>
                    <p class="text-muted small mt-2">Looker uses Gravatar for profile pictures.</p>
                </div>
            </div>

            <!-- User ma'lumotlari o'ng tomonda -->
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h3 class="h5 text-center">Xush kelibsiz, {{ $user->name }}!</h3>

                    <div class="mt-3">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Full Name</h5>
                                <p class="card-text">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Email</h5>
                                <p class="card-text">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Role</h5>
                                <p class="card-text">{{ ucfirst($user->role->name) }}</p>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Password</h5>
                                <p class="card-text">********</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Change Password</a>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile button -->
                    <div class="text-end">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>

                <!-- Rolga qarab xabar -->
                <div
                    class="mt-3 p-3 rounded-lg 
                    {{ $user->isAdmin() ? 'bg-green-100' : ($user->isAgent() ? 'bg-yellow-100' : 'bg-blue-100') }}">
                    <p>
                        @if ($user->isAdmin())
                            Siz administratorsiz! Tizimni boshqarish imkoniyatlariga egasiz.
                        @elseif ($user->isAgent())
                            Siz agentsiz! Mulk qo‘shish va boshqarish mumkin.
                        @else
                            Siz oddiy foydalanuvchisiz. Mulk ko‘rish va bog‘lanish mumkin.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
