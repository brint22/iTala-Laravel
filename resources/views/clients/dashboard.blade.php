<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Client Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="
                    background-color: #111827;
                    color: white;">
                    <h3 class="text-lg font-bold mb-4">Session Summary</h3>

                    @php
                    $sessionSummaries = $sessionNotes->where('format_type', 'Session Summary');
                    @endphp

                    @if($sessionSummaries->isEmpty())
                    <p class="text-gray-500">No session summary notes available.</p>
                    @else
                    @foreach($sessionSummaries as $note)
                    @php
                    preg_match('/Title:\s*(.*?)\s*Description:\s*(.*)/', $note->description, $matches);
                    $title = $matches[1] ?? 'N/A';
                    $description = $matches[2] ?? $note->description;

                    $appointment = \App\Models\Appointment::find($note->appointment_id);
                    @endphp

                    <div class="border rounded p-4 mb-4 bg-gray-50 shadow" style="
                                background-color: #111827;
                                color: white;">

                        <p class="text-sm text-gray-600 mb-1" style="color: lightgray;">
                            <strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($note->created_at)->format('F d, Y - h:i A') }}
                        </p>

                        <p class="text-sm text-gray-400 mb-2">
                            <strong>Related Appointment:</strong>
                            @if($appointment)
                            {{ $appointment->TypeofAppointment ?? 'Unknown Type' }} -
                            {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('M j, Y g:i A') }}
                            @else
                            N/A
                            @endif
                        </p>
                        <p class="mb-1">
                            <strong>Title:</strong> {{ $title }}
                        </p>

                        <p>
                            <strong>Description:</strong> {{ $description }}
                        </p>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>