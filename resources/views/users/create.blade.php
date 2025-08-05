<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success flash message --}}
            @if(session('success'))
                <div class="mb-4 text-green-500 font-semibold">
                    {{ session('success') }}
                </div>
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
                        <input type="text" name="contact_number" value="{{ old('contact_number') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
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
                        <input type="password" name="password" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
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
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded" style="border: 2px solid #5b626e; border-radius: 4pt;">
                        Create User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
