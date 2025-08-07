<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Set Password for Client
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-md mx-auto px-4">
            <div class="bg-gray-900 shadow-md rounded-lg p-6 border border-gray-700">

                {{-- Success or Error Messages --}}
                @if(session('success'))
                <div class="bg-green-500 text-white px-6 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="bg-red-500 text-white px-6 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif

                {{-- Password Form --}}
                <form method="POST" action="{{ route('clients.storeaccount', $client->id) }}">
                    @csrf

                    {{-- Email (readonly) --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-white mb-2">Client Email</label>
                        <input type="email" id="email" value="{{ $client->email }}" readonly
                            class="w-full px-4 py-3 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    {{-- Hidden fields for first name / last name to ensure completeness --}}
                    <input type="hidden" name="first_name" value="{{ $client->first_name }}">
                    <input type="hidden" name="last_name" value="{{ $client->last_name }}">

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-semibold text-white mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-semibold text-white mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition duration-200">
                            Save Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@elseif(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: "{{ session('error') }}",
    });
</script>
@endif