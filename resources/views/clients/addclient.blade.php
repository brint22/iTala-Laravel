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
                    document.addEventListener('DOMContentLoaded', function () {
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

                    <!-- First Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Middle Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Name Extension -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name Extension</label>
                        <input type="text" name="name_extension" value="{{ old('name_extension') }}"
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Birthdate -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birthdate</label>
                        <input type="date" name="birthdate" value="{{ old('birthdate') }}" required
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Gender -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                        <select name="gender" required
                                class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Civil Status -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Civil Status</label>
                        <select name="civil_status" required
                                class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                            <option value="">Select Civil Status</option>
                            <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" required
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                        <input type="text" name="contact_number" value="{{ old('contact_number') }}" required
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Emergency Contact Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}"
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Emergency Contact Number -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Number</label>
                        <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}"
                               class="mt-1 block w-full bg-gray-900 text-white border border-gray-600 rounded p-2">
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
