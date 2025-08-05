<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Client
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        background: '#1f2937',
                        color: '#f9fafb',
                        customClass: {
                            popup: 'rounded-xl shadow-lg'
                        }
                    });
                });
            </script>
            @endif

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
                <form method="POST" action="{{ route('clients.store') }}">
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

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
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

                    {{-- Civil Status --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Civil Status</label>
                        <select name="civil_status" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                            <option value="">Select Civil Status</option>
                            <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Separated" {{ old('civil_status') == 'Separated' ? 'selected' : '' }}>Separated</option>
                        <option value="Annulled" {{ old('civil_status') == 'Annulled' ? 'selected' : '' }}>Annulled</option>
                            <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>

                    {{-- Address --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    {{-- Contact Number --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-white text-sm rounded-l border border-r-0" style="background-color: #111827; border-color: #283141;">+63</span>
                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" maxlength="10" pattern="[0-9]{10}"
                                class="mt-1 block w-full rounded-r" style="background-color: #111827; color: white; border: 1px solid #283141;" placeholder="9123456789" required>
                        </div>
                        <small class="text-gray-400">Enter 10-digit mobile number after +63</small>
                    </div>

                    {{-- Emergency Contact Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    {{-- Emergency Contact Number --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Number</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-white text-sm rounded-l border border-r-0" style="background-color: #111827; border-color: #283141;">+63</span>
                            <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" maxlength="10" pattern="[0-9]{10}"
                                class="mt-1 block w-full rounded-r" style="background-color: #111827; color: white; border: 1px solid #283141;" placeholder="9123456789" required>
                        </div>
                        <small class="text-gray-400">Enter 10-digit mobile number after +63</small>
                    </div>

            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>