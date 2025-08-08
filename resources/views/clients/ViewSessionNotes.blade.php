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
        <div class="py-6 px-4 max-w-4xl mx-auto" style="max-width: 70%;">
            @php
            date_default_timezone_set('Asia/Manila');
            @endphp

            @if ($client->sessionNotes->isNotEmpty())
            <div>
                @foreach ($client->sessionNotes as $note)
                <div
                    class="bg-gray-800 text-white p-4 rounded-lg shadow mb-4 cursor-pointer hover:bg-gray-700 transition-all duration-200"
                    @click="open = true; selectedNote = {{ json_encode($note) }}">
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($note->created_at)->timezone('Asia/Manila')->format('F j, Y - g:i A') }}</p>
                    <p><strong>Format Type:</strong> {{ $note->format_type }}</p>
                    <p class="text-sm text-gray-400 mb-2">
                        <strong>Related Appointment:</strong>
                        @if ($note->appointment)
                        {{ $note->appointment->TypeofAppointment ?? 'Unknown Type' }} -
                        {{ \Carbon\Carbon::parse($note->appointment->Date . ' ' . $note->appointment->Time)->format('M j, Y g:i A') }}
                        @else
                        N/A
                        @endif
                    </p>
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


                <h3 class="text-lg font-bold mb-3 text-white text-center">Session Note Details</h3>

                <p class="text-white text-sm mb-1"><strong>Date Creation:</strong>
                    <span x-text="new Date(selectedNote.created_at).toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true })"></span>
                </p>

                <p class="text-white text-sm mb-1"><strong>Related Appointment:</strong>
                    <template x-if="selectedNote.appointment">
                        <span x-text="`${selectedNote.appointment?.TypeofAppointment ?? 'Unknown Type'} - ${new Date(selectedNote.appointment?.Date + ' ' + selectedNote.appointment?.Time).toLocaleString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true })}`"></span>
                    </template>
                    <template x-if="!selectedNote.appointment">
                        <span>N/A</span>
                    </template>
                </p>

                <p class="text-white text-sm mb-1"><strong>FType:</strong>
                    Subjective Objective Assessment Plan (<span x-text="selectedNote.format_type"></span>)
                </p>

                <template x-if="selectedNote.description">
                    <div class="mt-4 text-white text-sm">
                        <p class="font-semibold mb-1">Session Note Content:</p>
                        <div class="bg-gray-900 p-3 rounded text-white text-sm" style="white-space: pre-wrap; display: flex;">
                            <span x-text="selectedNote.description.trim()"></span>
                        </div>
                    </div>
                </template>


            </div>
        </div>
    </div>
    @else
    <p class="text-center text-gray-400 italic mt-10">This client has no appointments yet.</p>
    @endif
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('noteDisplay', () => ({
            selectedNote: {},

            get cleanedDescription() {
                if (!this.selectedNote.description) return '';
                return this.selectedNote.description
                    .replace(/[ \t]+\n/g, '\n') // remove spaces before line breaks
                    .replace(/\n{2,}/g, '\n') // remove extra blank lines
                    .trim(); // remove leading/trailing space
            }
        }))
    })
</script>