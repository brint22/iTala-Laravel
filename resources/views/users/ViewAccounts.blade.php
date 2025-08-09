<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                View Accounts
            </h2>
            <a href="{{ url('/dashboard') }}"
                class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                Return
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">All User Accounts</h3>

                    @php
                    $filteredUsers = $users->filter(function ($user) {
                        $currentRole = auth()->user()->role;

                        if ($currentRole === 'super_admin') {
                            return in_array($user->role, ['admin', 'Registered Psychometrician']);
                        }

                        if ($currentRole === 'admin') {
                            return $user->role === 'Registered Psychometrician';
                        }

                        return false;
                    });

                    $rolePriority = [
                        'admin' => 1,
                        'Registered Psychometrician' => 2,
                    ];

                    $filteredUsers = $filteredUsers->sort(function ($a, $b) use ($rolePriority) {
                        $roleA = $rolePriority[$a->role] ?? 99;
                        $roleB = $rolePriority[$b->role] ?? 99;

                        if ($roleA === $roleB) {
                            return strcmp(strtolower($a->name), strtolower($b->name));
                        }

                        return $roleA <=> $roleB;
                    });
                    @endphp

                    <table class="table-auto w-full border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-center">
                            <tr>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-center">Name</th>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-center">Email</th>
                                <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-center">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($filteredUsers as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">{{ $user->name }}</td>
                                <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">{{ $user->email }}</td>
                                <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    {{ ucfirst($user->role) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-sm text-gray-500 dark:text-gray-400 py-4">
                                    No user accounts found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
