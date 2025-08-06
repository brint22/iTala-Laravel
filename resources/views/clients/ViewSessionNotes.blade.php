<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Session Notes for {{ $client->first_name }} {{ $client->last_name }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        @forelse ($client->sessionNotes as $note)
            <div class="bg-gray-700 text-white p-4 rounded mb-4">
                <p><strong>Date:</strong> {{ $note->created_at->format('F j, Y') }}</p>
                <p><strong>Type:</strong> {{ $note->format_type }}</p>
                <p><strong>Description:</strong> {{ $note->description }}</p>
            </div>
        @empty
            <p class="text-gray-400 italic">No session notes found.</p>
        @endforelse
    </div>
</x-app-layout>
