<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Registered Psychometrician Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @php
            date_default_timezone_set('Asia/Manila');
            $hour = date('H');
            $greeting = match (true) {
            $hour >= 5 && $hour < 12=> 'Good Morning',
                $hour >= 12 && $hour < 13=> 'Good Noon',
                    $hour >= 13 && $hour < 18=> 'Good Afternoon',
                        $hour >= 18 && $hour < 22=> 'Good Evening',
                            default => 'Good Night',
                            };

                            $firstName = explode(' ', Auth::user()->name)[0];
                            @endphp

                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-lg shadow-md mb-10">
                                <h3 class="text-2xl font-bold">{{ $greeting }}, {{ $firstName }}!</h3>
                                <p class="mt-2 text-sm text-white/80">Manage your users, view reports, and perform assessments.</p>
                            </div>

                            <!-- Cards Row -->
                            <div class="flex flex-col lg:flex-row gap-6">

                                <!-- Card 1: Add Client -->
                                <div class="w-full lg:w-1/4 p-4 shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl backdrop-blur-md"
                                    style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px;">
                                    <h4 class="text-lg font-semibold text-white mb-2">Add Client Information</h4>
                                    <p class="text-sm text-white/70 mb-4" style="color: lightgray;">
                                        Register a new user into the system.
                                    </p>
                                    <form action="{{ url('/clients/addclient') }}" method="GET">
                                        <button type="submit"
                                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
                                            style="color: lightyellow; font-weight: bold; text-align: left;">
                                            Go to User Form
                                        </button>
                                    </form>
                                </div>

                                <!-- Card 2: View Clients -->
                                <div class="w-full lg:w-1/4 p-4 shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl backdrop-blur-md"
                                    style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px;">
                                    <h4 class="text-lg font-semibold text-white mb-2">View Clients</h4>
                                    <p class="text-sm text-white/70 mb-4" style="color: lightgray;">
                                        Browse the list of allclients.
                                    </p>
                                    <a href="{{ route('clients.index') }}""
                                        class="block w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition"
                                        style="color: lightyellow; font-weight: bold; text-align: left;">
                                        View Clients
                                    </a>
                                </div>

                                <!-- Card 3: View Reports -->
                                <div class="w-full lg:w-1/4 p-4 shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl backdrop-blur-md"
                                    style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px;">
                                    <h4 class="text-lg font-semibold text-white mb-2">View Reports</h4>
                                    <p class="text-sm text-white/70 mb-4" style="color: lightgray;">
                                        Check psychometric reports.
                                    </p>
                                    <a href="#"
                                        class="block w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition"
                                        style="color: lightyellow; font-weight: bold; text-align: left;">
                                        View Reports
                                    </a>
                                </div>

                                <!-- Card 4: Settings -->
                                <div class="w-full lg:w-1/4 p-4 shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl backdrop-blur-md"
                                    style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px;">
                                    <h4 class="text-lg font-semibold text-white mb-2">Settings</h4>
                                    <p class="text-sm text-white/70 mb-4" style="color: lightgray;">
                                        Update your profile.
                                    </p>
                                    <a href="#"
                                        class="block w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition"
                                        style="color: lightyellow; font-weight: bold; text-align: left;">
                                        Account Settings
                                    </a>
                                </div>

                            </div>
        </div>
    </div>
</x-app-layout>