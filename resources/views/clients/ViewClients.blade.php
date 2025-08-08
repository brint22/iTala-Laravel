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
                <div x-data="{ open: false, showAppointments: false }">

                    <style>
                        .hover-layer::before {
                            content: "";
                            position: absolute;
                            inset: 0;
                            background-color: #0000001f;
                            /* same as bg-gray-700 */
                            border-radius: 0.5rem;
                            /* match rounded-lg */
                            opacity: 0;
                            transition: opacity 0.3s ease;
                            z-index: 0;
                        }

                        .hover-layer:hover::before {
                            opacity: 1;
                        }

                        .hover-layer>* {
                            position: relative;
                            z-index: 1;
                        }

                        .hover-container:hover .hover-controls {
                            display: flex !important;
                        }
                    </style>

                    <!-- Client Card -->
                    <div x-data="{ clicked: false }"
                        class="hover-container hover-layer bg-gray-800 shadow rounded-lg p-4 transition"
                        style="position: relative; margin-bottom: 1em;">

                        <div class="flex items-start justify-between">
                            <!-- Left: Clickable Area for Modal -->
                            <div @click="open = true" class="cursor-pointer flex-1">
                                <h3 class="text-white text-lg font-semibold">
                                    {{ $client->last_name }}, {{ $client->first_name }} {{ $client->middle_name }}
                                    {{ $client->name_extension }}
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

                            <!-- Right: Appointment Controls -->
                            <div class="hover-controls ml-4 shrink-0 flex flex-col items-center space-y-2"
                                style="
                                display: none;
                                flex-direction: row;
                                align-items: center;
                                justify-content: center;
                                gap: 1em;
                                padding: 0;
                                margin: 0;
                                position: absolute;
                                top: 50%;
                                right: 1em;
                                transform: translateY(-50%);
                                z-index: 10;
                            ">


                                @php
                                $hasAppointments = $client->appointments()->exists();
                                $hasSessionNotes = $client->sessionNotes()->exists();
                                @endphp

                                @if ($hasSessionNotes)
                                <a href="{{ route('clients.viewsessionnotes', ['client' => $client->id]) }}"
                                    class="px-3 py-1 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded shadow w-max"
                                    style="padding: 1em; background-color: #c09fff42;">
                                    View Session Notes
                                </a>
                                @elseif ($hasAppointments)
                                <span class="text-xs text-gray-400 italic" style="margin: 0 !important;">[No Session Note]</span>
                                @endif


                                {{-- ✅ Add Session Note Button (only if appointments exist) --}}
                                @if ($client->appointments->count() > 0)
                                <a href="{{ route('clients.addsessionnote', ['client' => $client->id]) }}"
                                    class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded shadow w-max"
                                    style="padding: 1em; background-color: #d6e0ff42; margin: 0;">
                                    Add Session Note
                                </a>
                                @endif

                                {{-- Conditional View/No Appointment --}}
                                @if ($client->appointments->count() > 0)
                                <button @click.stop="showAppointments = true"
                                    class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded shadow w-max"
                                    style="padding: 1em; background-color: #6a85ab4d; margin: 0;">
                                    View Appointments
                                </button>
                                @else
                                <span class="text-xs text-gray-400 italic" style="margin: 0 !important;">[No Appointment]</span>
                                @endif

                                {{-- Add Appointment Button --}}
                                <a href="{{ route('clients.addappointment', ['client' => $client->id]) }}"
                                    class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded shadow w-max"
                                    style="padding: 1em; margin: 0; background-color: #ffffe042;">
                                    Add Appointment
                                </a>

                                {{-- Add Account Button --}}
                                @if(is_null($client->Password))
                                <a href="{{ route('clients.addaccount', ['client' => $client->id]) }}"
                                    class="px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-sm rounded shadow w-max"
                                    style="padding: 1em; margin: 0; background-color: #c4c4ff52;">
                                    Add Account
                                </a>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- Client Details Modal -->
                    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50"
                        style="background-color: #00000033; backdrop-filter: blur(50px);"
                        @keydown.escape.window="open = false">
                        <div class="animate-fadeInScale"
                            style="width: 500px; padding: 2em; background-color: #ffffff2b; color: white; border-radius: 0.5rem; max-height: 90vh; overflow-y: auto; position: relative;">
                            <button @click="open = false" class="z-50"
                                style="position: absolute; top: 1rem; right: 1.5rem; color: white; font-size: 2.5rem; cursor: pointer;">
                                ×
                            </button>

                            <h2 style="text-align: left; font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
                                Client Details
                            </h2>

                            <div style="font-size: 1.1rem; color: white; gap: 0.2em; display: flex; flex-direction: column;">
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

                    @php
                    $appointments = $client->appointments;
                    @endphp
                    <!-- View Appointment Modal -->
                    <div x-show="showAppointments" x-cloak class="fixed inset-0 flex items-center justify-center z-50"
                        style="background-color: #00000033; backdrop-filter: blur(50px);" @keydown.escape.window="showAppointments = false">
                        <div class="animate-fadeInScale"
                            style="width: 600px; padding: 2em; background-color: #ffffff2b; color: white; border-radius: 0.5rem; max-height: 90vh; overflow-y: auto; position: relative;">

                            <!-- Close Button -->
                            <button @click="showAppointments = false"
                                style="position: absolute; top: 1rem; right: 1.5rem; color: white; font-size: 2.5rem; cursor: pointer;">
                                ×
                            </button>

                            <h2 style="text-align: left; font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
                                Appointments for {{ $client->full_name }}
                            </h2>

                            @if ($appointments->isEmpty())
                            <p style="color: #d1d5db;">No appointments found.</p>
                            @else
                            <div style="display: flex; flex-direction: column; gap: 1rem; max-height: 60vh; overflow-y: auto;">
                                @foreach ($appointments as $appointment)
                                <div style="border: 1px solid #ccc; border-radius: 0.5rem; padding: 1rem; background-color: #ffffff22;">
                                    <p><strong>Type of Appointment:</strong> {{ $appointment->TypeofAppointment }}</p>
                                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->Date)->format('F d, Y') }}</p>
                                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->Time)->format('h:i A') }}</p>
                                    <p><strong>Duration:</strong> {{ $appointment->Duration }}</p>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <div style="text-align: right; margin-top: 1.5rem;">
                                <button @click="showAppointments = false"
                                    style="padding: 0.5rem 1.5rem; background-color: #1f2937; color: white; border-radius: 0.375rem; cursor: pointer;">
                                    Close
                                </button>
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

<style>
    .hover-container:hover .hover-controls {
        display: flex !important;
    }
</style>

