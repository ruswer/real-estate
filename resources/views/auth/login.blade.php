<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-center">Sign In</h2>

        <!-- Umumiy xatoliklarni ko‘rsatish -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf

            <!-- Email input -->
            <div>
                <input type="email" name="email" placeholder="Email Address" required
                    class="w-full p-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password input -->
            <div class="mt-2">
                <input type="password" name="password" placeholder="Password" required
                    class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center mt-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <a href="" class="text-sm text-blue-600">Forgot Password?</a>
            </div>

            <!-- Submit button -->
            <button type="submit" class="w-full bg-orange-500 text-white py-2 mt-3 rounded">Sign In</button>
        </form>

        <p class="text-center mt-3">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600">Register</a>
        </p>

        <div class="text-center mt-3 text-gray-500">or</div>

        <!-- Social Login -->
        <div class="mt-3">
            <a href="#" class="w-full block bg-white border flex items-center justify-center py-2 rounded shadow">
                <img src="{{ asset('images/google-icon.png') }}" class="w-5 h-5 mr-2" alt="Google">
                Continue with Google
            </a>
            <a href="#"
                class="w-full block bg-white border flex items-center justify-center py-2 mt-2 rounded shadow">
                <img src="{{ asset('images/facebook-icon.png') }}" class="w-5 h-5 mr-2" alt="Facebook">
                Continue with Facebook
            </a>
        </div>
    </div>
</x-guest-layout>
