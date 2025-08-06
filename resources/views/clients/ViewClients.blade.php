<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            View Registered Clients
        </h2>
    </x-slot>

    <style>
        [x-cloak] {
            display: none !important;
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fadeInScale {
            animation: fadeInScale 0.25s ease-out;
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($clients as $client)
                <div x-data="{ open: false }">
                    <!-- Client Card -->
                    <div
                        class="bg-gray-800 shadow rounded-lg p-4 cursor-pointer hover:bg-gray-700 transition"
                        @click="open = true">
                        <h3 class="text-white text-lg font-semibold">
                            {{ $client->last_name }}, {{ $client->first_name }} {{ $client->middle_name }} {{ $client->name_extension }}
                        </h3>
                        <p class="text-sm text-gray-400 mt-2">
                            Date Added: {{ \Carbon\Carbon::parse($client->created_at)->format('F d, Y') }}
                        </p>
                        @if ($client->created_at != $client->updated_at)
                        <p class="text-sm text-gray-400">
                            Date Updated: {{ \Carbon\Carbon::parse($client->updated_at)->format('F d, Y') }}
                        </p>
                        @endif
                    </div>

                    <!-- Modal -->
                    <div
                        x-show="open"
                        x-cloak
                        class="fixed inset-0 flex items-center justify-center z-50"
                        style="
                            background-color: #00000033;
                            backdrop-filter: blur(50px);
                        "
                        @keydown.escape.window="open = false">
                        <!-- Modal Card -->
                        <div
                            class="animate-fadeInScale"
                            style="
                                width: 500px;
                                padding: 2em;
                                background-color: #ffffff2b;
                                color: white;
                                border-radius: 0.5rem;
                                max-height: 90vh;
                                overflow-y: auto;
                                position: relative;
                            ">
                            <!-- Close Button -->
                            <button
                                @click="open = false"
                                class="z-50"
                                style="
                                    position: absolute;
                                    top: 1rem;
                                    right: 1.5rem;
                                    color: white;
                                    font-size: 2.5rem;
                                    display: flex;
                                    justify-content: flex-end;
                                    cursor: pointer;
                                ">
                                ×
                            </button>

                            <!-- Modal Content -->
                            <h2
                                style="
                                    text-align: left;
                                    font-size: 1.5rem;
                                    font-weight: bold;
                                    margin-bottom: 1.5rem;
                                ">
                                Client Details
                            </h2>

                            <div style="font-size: 1.1rem;color: white;gap: 0.2em;display: flex;flex-direction: column;">
                                <p><strong>Full Name:</strong> {{ $client->last_name }}, {{ $client->first_name }} {{ $client->middle_name }} {{ $client->name_extension }}</p>
                                <p><strong>Birthdate:</strong> {{ \Carbon\Carbon::parse($client->birthdate)->format('F d, Y') }}</p>
                                <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($client->birthdate)->age }} years old</p>
                                <p><strong>Gender:</strong> {{ ucfirst($client->gender) }}</p>
                                <p><strong>Civil Status:</strong> {{ ucfirst($client->civil_status) }}</p>
                                <p><span class="font-semibold">Contact Number:</span> +63{{ ltrim($client->contact_number, '0') }}</p>
                                <p><strong>Email:</strong> {{ $client->email }}</p>
                                <p><strong>Address:</strong> {{ $client->address }}</p>
                                <p><strong>Emergency Contact Name:</strong> {{ $client->emergency_contact_name }}</p>
                                <p><span class="font-semibold">Emergency Contact Number:</span> +63{{ ltrim($client->emergency_contact_number, '0') }}</p>
                                <p><strong>Date Added:</strong> {{ \Carbon\Carbon::parse($client->created_at)->format('F d, Y') }}</p>
                                @if ($client->created_at != $client->updated_at)
                                <p><strong>Date Updated:</strong> {{ \Carbon\Carbon::parse($client->updated_at)->format('F d, Y') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-400 col-span-full">
                    No clients found.
                </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>