<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-white leading-tight">
            Set Password for Client
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto px-3">
            <div class="bg-gray-900 shadow-md rounded-lg p-4 border border-gray-950" style="border-color: #ffffff78;">

                {{-- Success or Error Messages --}}
                @if(session('success'))
                <div class="bg-green-500 text-white px-4 py-2 rounded mb-3 text-sm">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="bg-red-500 text-white px-4 py-2 rounded mb-3 text-sm">
                    {{ session('error') }}
                </div>
                @endif

                {{-- Password Form --}}
                <form method="POST" action="{{ route('clients.storeaccount', $client->id) }}">
                    @csrf

                    {{-- Email (readonly) --}}
                    <div class="mb-3">
                        <label for="email" class="block text-xs font-semibold text-white mb-1">Client Email</label>
                        <input type="email" id="email" value="{{ $client->email }}" readonly
                            class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                    </div>

                    {{-- Hidden fields --}}
                    <input type="hidden" name="first_name" value="{{ $client->first_name }}">
                    <input type="hidden" name="last_name" value="{{ $client->last_name }}">

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="block text-xs font-semibold text-white mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-xs font-semibold text-white mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition duration-200 text-sm">
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
