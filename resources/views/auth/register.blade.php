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
        <form id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
            class="mt-4">
            @csrf

            <div class="flex gap-2">
                <input type="text" name="first_name" placeholder="First Name" required
                    class="w-1/2 p-2 border rounded">
                <input type="text" name="last_name" placeholder="Last Name" required
                    class="w-1/2 p-2 border rounded">
            </div>

            <input type="email" name="email" placeholder="Email Address" required
                class="w-full mt-2 p-2 border rounded">
            <input type="password" name="password" placeholder="Password" required
                class="w-full mt-2 p-2 border rounded">

            <!-- Role (User = 3, Agent = 2) -->
            <input type="hidden" name="role_id" id="role_id" value="3">

            <!-- Agent Fields -->
            <div id="agent-fields" class="hidden">
                <input type="text" name="designation" placeholder="Designation (Lavozim)"
                    class="w-full mt-2 p-2 border rounded">
                <input type="file" name="image" class="w-full mt-2 p-2 border rounded">
                <input type="text" name="facebook" placeholder="Facebook URL" class="w-full mt-2 p-2 border rounded">
                <input type="text" name="twitter" placeholder="Twitter URL" class="w-full mt-2 p-2 border rounded">
                <input type="text" name="instagram" placeholder="Instagram URL"
                    class="w-full mt-2 p-2 border rounded">
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
