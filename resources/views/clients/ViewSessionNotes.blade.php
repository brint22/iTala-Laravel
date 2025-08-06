<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Session Notes for {{ $client->first_name }} {{ $client->last_name }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-4xl mx-auto">
        @if ($client->sessionNotes->isNotEmpty())
            @foreach ($client->sessionNotes as $note)
                <div class="bg-gray-800 text-white p-4 rounded-lg shadow mb-4">
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($note->created_at)->format('F j, Y') }}</p>
                    <p><strong>Type:</strong> {{ $note->format_type }}</p>
                    <p><strong>Description:</strong> {{ $note->description }}</p>
                </div>
            @endforeach
        @else
            <p class="text-gray-400 italic text-sm text-center">No session notes found for this client.</p>
        @endif
    </div>
</x-app-layout>
