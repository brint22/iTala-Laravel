<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Registered Psychometrician Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold">Welcome, Registered Psychometrician! 🎉</h3>
                <p class="mt-2 text-sm text-blue-100">Manage your users, view reports, and perform assessments.</p>
            </div>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Create User</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Register a new user into the system.</p>
                <form action="{{ route('clients.addclient') }}" method="GET">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Go to User Form
                    </button>
                </form>
            </div>
                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">View Reports</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Check generated psychometric reports.</p>
                    <a href="#" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        View Reports
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Settings</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Update your profile or change password.</p>
                    <a href="#" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                        Account Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
