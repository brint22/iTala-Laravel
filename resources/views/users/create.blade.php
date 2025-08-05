<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                        <input type="text" name="first_name" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Middle Name</label>
                        <input type="text" name="middle_name" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                        <input type="text" name="last_name" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name Extension</label>
                        <input type="text" name="name_extension" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birthdate</label>
                        <input type="date" name="birthdate" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                        <select name="gender" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                          <option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Non-binary">Non-binary</option>
<option value="Prefer not to say">Prefer not to say</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                        <input type="text" name="contact_number" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">License Number</label>
                        <input type="text" name="license_number" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="password" class="mt-1 block w-full rounded" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select name="role" class="mt-1 block w-full rounded border-gray-300" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                            <option value="admin">Admin</option>
                            <option value="Registered Psychometrician">Registered Psychometrician</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded" style="border: 2px solid #5b626e;border-radius: 4pt;">
                        Create User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
