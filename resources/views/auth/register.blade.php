<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-center">Create an Account</h2>

        <!-- Tab Navigation -->
        <div class="flex border-b mt-4">
            <button type="button" id="user-tab"
                class="w-1/2 text-center py-2 border-b-2 border-orange-500 font-semibold">
                Register
            </button>
            <button type="button" id="agent-tab" class="w-1/2 text-center py-2 border-b-2 border-gray-300">
                Agent Registration
            </button>
        </div>

        <!-- Register Form -->
        <form id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-4">
            @csrf
        
            <div class="flex gap-2">
                <input type="text" name="first_name" placeholder="First Name" required
                    class="w-1/2 p-2 border rounded @error('first_name') border-red-500 @enderror">
                @error('first_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        
                <input type="text" name="last_name" placeholder="Last Name" required
                    class="w-1/2 p-2 border rounded @error('last_name') border-red-500 @enderror">
                @error('last_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <input type="email" name="email" placeholder="Email Address" required
                class="w-full mt-2 p-2 border rounded @error('email') border-red-500 @enderror">
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        
            <input type="password" name="password" placeholder="Password" required
                class="w-full mt-2 p-2 border rounded @error('password') border-red-500 @enderror">
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        
            <input type="hidden" name="role_id" id="role_id" value="3">
        
            <div id="agent-fields" class="hidden">
                <input type="text" name="designation" placeholder="Designation (Lavozim)"
                    class="w-full mt-2 p-2 border rounded @error('designation') border-red-500 @enderror">
                @error('designation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        
                <input type="file" name="image" class="w-full mt-2 p-2 border rounded @error('image') border-red-500 @enderror">
                @error('image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        
                <input type="text" name="facebook" placeholder="Facebook URL"
                    class="w-full mt-2 p-2 border rounded @error('facebook') border-red-500 @enderror">
                @error('facebook')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        
                <input type="text" name="twitter" placeholder="Twitter URL"
                    class="w-full mt-2 p-2 border rounded @error('twitter') border-red-500 @enderror">
                @error('twitter')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
        
                <input type="text" name="instagram" placeholder="Instagram URL"
                    class="w-full mt-2 p-2 border rounded @error('instagram') border-red-500 @enderror">
                @error('instagram')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" id="continue-btn" class="w-full bg-orange-600 text-white py-2 mt-3 rounded">
                Register
            </button>
        </form>
        

        <p class="text-center mt-3">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600">Sign In</a>
        </p>

        <script>
            document.getElementById('user-tab').addEventListener('click', function() {
                document.getElementById('role_id').value = 3; // User
                document.getElementById('agent-fields').classList.add('hidden');
                this.classList.add('border-orange-500');
                this.classList.remove('border-gray-300');
                document.getElementById('agent-tab').classList.remove('border-orange-500');
                document.getElementById('agent-tab').classList.add('border-gray-300');
            });

            document.getElementById('agent-tab').addEventListener('click', function() {
                document.getElementById('role_id').value = 2; // Agent
                document.getElementById('agent-fields').classList.remove('hidden');
                this.classList.add('border-orange-500');
                this.classList.remove('border-gray-300');
                document.getElementById('user-tab').classList.remove('border-orange-500');
                document.getElementById('user-tab').classList.add('border-gray-300');
            });
        </script>
    </div>
</x-guest-layout>
