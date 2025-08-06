<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Session Notes for {{ $client->first_name }} {{ $client->last_name }}
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
    </style>

    @if ($client->appointments->isNotEmpty())
    <div x-data="{ open: false, selectedNote: {} }" x-cloak>
        <div class="py-6 px-4 max-w-4xl mx-auto">
            @if ($client->sessionNotes->isNotEmpty())
            <div>
                @foreach ($client->sessionNotes as $note)
                <div
                    class="bg-gray-800 text-white p-4 rounded-lg shadow mb-4 cursor-pointer hover:bg-gray-700 transition-all duration-200"
                    @click="open = true; selectedNote = {{ $note->toJson() }}">
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($note->created_at)->format('F j, Y') }}</p>
                    <p><strong>Type:</strong> {{ $note->format_type }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 italic text-sm text-center">No session notes found for this client.</p>
            @endif
        </div>

        <div x-show="open"
            class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
            style="background-color: #00000033; backdrop-filter: blur(50px);">
            <div class="animate-fadeInScale relative overflow-y-auto"
                style="
            width: 500px;
            padding: 2em;
            background-color: #80808033;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        "
                @click.away="open = false">
                <!-- X Button -->
                <button @click="open = false"
                    class="absolute top-4 right-4 text-white text-xl hover:text-gray-300 transition"
                    aria-label="Close" style="position: absolute; top: 1rem; right: 1.5rem; color: white; font-size: 2.5rem; cursor: pointer;">&times;</button>

                <h3 class="text-xl font-bold mb-4 text-white">Session Note Details</h3>
                <p class="text-white"><strong>Date:</strong>
                    <span x-text="new Date(selectedNote.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })"></span>
                </p>
                <p class="text-white"><strong>Type:</strong> <span x-text="selectedNote.format_type"></span></p>
                <p class="text-white"><strong>Related Appointment Date:</strong>
                    <span x-text="
        selectedNote.appointment?.date && selectedNote.appointment?.type 
            ? new Date(selectedNote.appointment.date).toLocaleString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            }) + ' (' + selectedNote.appointment.type + ')' 
            : 'N/A'
    "></span>
                </p>

                <span x-text="selectedNote.appointment ? new Date(selectedNote.appointment.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : 'N/A'"></span>
                </p>
                <p class="text-white mt-4"><strong>Description:</strong></p>
                <p class="text-white" x-text="selectedNote.description"></p>
            </div>
        </div>
    </div>
    @else
    <p class="text-center text-gray-400 italic mt-10">This client has no appointments yet.</p>
    @endif
</x-app-layout>