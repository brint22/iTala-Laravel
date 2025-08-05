<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- ✅ SweetAlert2 CDN --}}

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            {{-- ✅ SweetAlert2 Success Popup --}}
            @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true,
                        background: '#1f2937', // Tailwind's gray-800
                        color: '#f9fafb', // Tailwind's gray-50
                        customClass: {
                            popup: 'rounded-xl shadow-lg'
                        }
                    });
                });
            </script>
            @endif



            {{-- Validation errors --}}
            @if ($errors->any())
            <div class="mb-4 text-red-500 font-medium">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif




            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    {{-- First Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    {{-- Middle Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    {{-- Last Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    {{-- Name Extension --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name Extension</label>
                        <input type="text" name="name_extension" value="{{ old('name_extension') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    {{-- Birthdate --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birthdate</label>
                        <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                        <select name="gender" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Non-binary" {{ old('gender') == 'Non-binary' ? 'selected' : '' }}>Non-binary</option>
                            <option value="Prefer not to say" {{ old('gender') == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                        </select>
                    </div>

                    {{-- Contact Number --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-white text-sm rounded-l border border-r-0" style="background-color: #111827; border-color: #283141;">+63</span>
                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" maxlength="10" pattern="[0-9]{10}"
                                class="mt-1 block w-full rounded-r"
                                style="background-color: #111827; color: white; border: 1px solid #283141;" placeholder="9123456789" required>
                        </div>
                        <small class="text-gray-400">Enter 10-digit mobile number after +63</small>
                    </div>

                    {{-- License Number --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">License Number</label>
                        <input type="text" name="license_number" value="{{ old('license_number') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full rounded border"
                            style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <input type="password" id="confirm_password" name="password_confirmation"
                            class="mt-1 block w-full rounded border"
                            style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                        <p id="password_error" class="text-red-500 text-sm mt-1 hidden">Passwords do not match.</p>
                    </div>


                    {{-- Role --}}
                    @if(Auth::user()->role === 'super_admin')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select name="role" class="mt-1 block w-full rounded border-gray-300" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Registered Psychometrician" {{ old('role') == 'Registered Psychometrician' ? 'selected' : '' }}>Registered Psychometrician</option>
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="role" value="Registered Psychometrician">
                    @endif

                    {{-- Submit --}}
                    <button id="submitBtn" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded disabled:opacity-50 disabled:cursor-not-allowed"
                        style="border: 2px solid #5b626e; border-radius: 4pt;" disabled>
                        Create User
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const errorText = document.getElementById('password_error');
        const submitBtn = document.getElementById('submitBtn');

        function validatePasswords() {
            if (confirmPassword.value === '') {
                errorText.classList.add('hidden');
                confirmPassword.style.borderColor = '#283141';
                submitBtn.disabled = true;
                return;
            }

            if (password.value !== confirmPassword.value) {
                errorText.classList.remove('hidden');
                confirmPassword.style.borderColor = 'red';
                submitBtn.disabled = true;
            } else {
                errorText.classList.add('hidden');
                confirmPassword.style.borderColor = '#10b981'; // green
                submitBtn.disabled = false;
            }
        }

        password.addEventListener('input', validatePasswords);
        confirmPassword.addEventListener('input', validatePasswords);

        form.addEventListener('submit', function (e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
            }
        });
    });
</script>
