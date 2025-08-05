<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            View Registered Clients
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6">

                <table class="min-w-full divide-y divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-300" style="color: white; background-color: #ffffe02e;">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-300" style="color: white; background-color: #ffffe02e;">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-300" style="color: white; background-color: #ffffe02e;">Gender</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-300" style="color: white; background-color: #ffffe02e;">Birthdate</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-300" style="color: white; background-color: #ffffe02e;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($clients as $client)
                            <tr>
                                <td class="px-4 py-2 text-white">{{ $client->last_name }}, {{ $client->first_name }} {{ $client->middle_name }}</td>
                                <td class="px-4 py-2 text-gray-300" style="color: white;">{{ $client->email }}</td>
                                <td class="px-4 py-2 text-gray-300" style="color: white;">{{ $client->gender }}</td>
                                <td class="px-4 py-2 text-gray-300" style="color: white;">{{ \Carbon\Carbon::parse($client->birthdate)->format('F d, Y') }}</td>
                                <td class="px-4 py-2" style="color: white;">
                                    <a href="#" class="text-blue-400 hover:underline text-sm">View</a>
                                    {{-- Add Edit/Delete if needed --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-400">No clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $clients->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
