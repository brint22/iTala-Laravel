<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            View Accounts
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">All User Accounts</h3>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            @endphp

                            @forelse ($filteredUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
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
