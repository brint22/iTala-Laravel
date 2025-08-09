<x-app-layout>
    <style>
        body {
            background-color: rgb(31, 41, 55) !important;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Add Appointment for {{ $client->first_name }} {{ $client->last_name }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: rgb(31, 41, 55); min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            {{-- Success Alert --}}
            @if(session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK',
                        background: '#1f2937',
                        color: '#f9fafb',
                        customClass: {
                            popup: 'rounded-xl shadow-lg',
                            confirmButton: 'bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('clients.index') }}";
                        }
                    });
                });
            </script>
            @endif

            {{-- Already Added Alert --}}
            @if (session('exists'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already Added',
                        text: "{{ session('exists') }}",
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        background: '#1f2937',
                        color: '#f9fafb',
                        customClass: {
                            popup: 'rounded-xl shadow-lg',
                            confirmButton: 'bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg'
                        }
                    });
                });
            </script>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
            <div class="mb-4 text-red-400 font-medium">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Appointment Form --}}
            <div class="shadow-sm sm:rounded-lg p-6" style="background-color:rgba(255, 255, 255, 0.14); border: 1px solid #374151;">
                <form id="appointmentForm" method="POST" action="{{ route('client.storeappointment') }}">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $client->id }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white">Client Name</label>
                        <input type="text" disabled value="{{ $client->first_name }} {{ $client->last_name }}"
                            class="form-control" style="background-color: #111827; color: white; border: 1px solid #283141;">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white">Type of Appointment</label>
                        <select name="TypeofAppointment" required
                            class="form-control"
                            style="background-color: #111827; color: white; border: 1px solid #283141;">
                            <option value="" disabled selected>Select appointment type</option>
                            <option value="Consultation" {{ old('TypeofAppointment') == 'Consultation' ? 'selected' : '' }}>Consultation</option>
                            <option value="Follow-up" {{ old('TypeofAppointment') == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="Duration" class="block text-sm font-medium text-white">Duration (HH:MM)</label>
                        <input type="text" name="Duration" id="Duration" value="{{ old('Duration') }}"
                            class="form-control"
                            placeholder="e.g. 01:30"
                            pattern="^(0[1-9]|1[0-2]):([0-5][0-9])$"
                            title="Enter time in 12-hour format (HH:MM), without AM/PM"
                            style="background-color: #111827; color: white; border: 1px solid #283141;"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white">Date</label>
                        <style>
                            input[type="date"]::-webkit-calendar-picker-indicator {
                                filter: invert(1);
                            }
                        </style>
                        <input
                            type="date"
                            name="Date"
                            value="{{ old('Date') }}"
                            class="form-control"
                            style="background-color: #111827; color: white; border: 1px solid #283141;"
                            required>
                    </div>

                    <style>
                        input[type="time"]::-webkit-calendar-picker-indicator {
                            filter: invert(1);
                        }
                    </style>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white">Time</label>
                        <input type="time" name="Time" value="{{ old('Time') }}"
                            class="form-control" step="60" style="background-color: #111827; color: white; border: 1px solid #283141;" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Submit Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Confirmation Dialog --}}
    <script>
        document.getElementById('appointmentForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent immediate submission

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to add this appointment?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, add it!',
                background: '#1f2937',
                color: '#f9fafb',
                customClass: {
                    popup: 'rounded-xl shadow-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
</x-app-layout>