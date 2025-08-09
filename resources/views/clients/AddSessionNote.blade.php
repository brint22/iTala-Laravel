<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Add A Session Note for {{ $client->first_name }} {{ $client->last_name }}
            </h2>
            <a href="{{ url('/clients') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Return
            </a>
        </div>
    </x-slot>

    <style>
        body {
            background-color: rgb(31, 41, 55) !important;
        }

        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>

    <div class="py-6" style="min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    background: '#1f2937',
                    color: '#f9fafb',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
            @endif

            @if ($errors->any())
            <div class="mb-4 text-red-400 font-medium">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="shadow-sm sm:rounded-lg p-6" style="background-color: rgba(255, 255, 255, 0.08); border: 1px solid #374151;">
                <form id="sessionForm" method="POST" action="{{ route('clients.storesessionnote') }}">
                    @csrf
                    {{-- Inside your <form> --}}
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="description" id="descriptionInput">

                    {{-- Select from existing appointments --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white">Select Appointment</label>
                        <select name="appointment_id" required
                            class="form-control"
                            style="background-color: #111827; color: white; border: 1px solid #283141;">
                            <option value="">-- Select Appointment --</option>
                            @foreach ($client->appointments as $appt)
                            <option value="{{ $appt->id }}">
                                {{ $appt->Date }} - {{ \Carbon\Carbon::parse($appt->Time)->format('h:i A') }} ({{ $appt->TypeofAppointment }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Format Type Dropdown -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white">Format Type</label>
                        <select id="formatType" name="format_type" required
                            class="form-control"
                            style="background-color: #111827; color: white; border: 1px solid #283141;">
                            <option value="">-- Select Format --</option>
                            <option value="SOAP">SOAP</option>
                            <option value="DAP">DAP</option>
                            <option value="Session Summary">Session Summary</option>
                        </select>
                    </div>

                    <!-- Session Summary Fields -->
                    <div id="summaryFields" class="hidden">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Title</label>
                            <input type="text" id="summaryTitle" class="form-control bg-gray-900 text-white border border-gray-700"
                                style="background-color: #111827; width: 100%;" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Description</label>
                            <textarea id="summaryDescription" class="form-control bg-gray-900 text-white border border-gray-700"
                                rows="4" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                    </div>

                    {{-- SOAP F
                    {{-- SOAP Format --}}
                    <div id="soapFields" class="hidden">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Subjective</label>
                            <textarea id="subjective" class="form-control bg-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Objective</label>
                            <textarea id="objective" class="form-control bg-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Assessment</label>
                            <textarea id="assessment" class="form-control bga-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Plan</label>
                            <textarea id="plan" class="form-control bg-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                    </div>

                    {{-- DAP Format --}}
                    <div id="dapFields" class="hidden">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Data</label>
                            <textarea id="data" class="form-control bg-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Assessment</label>
                            <textarea id="dap_assessment" class="form-control bg-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-white">Plan</label>
                            <textarea id="dap_plan" class="form-control bg-gray-900 text-white border border-gray-700" rows="2" style="background-color: #111827; width: 100%;"></textarea>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save Session Note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const formatSelect = document.getElementById('formatType');
        const soapFields = document.getElementById('soapFields');
        const dapFields = document.getElementById('dapFields');
        const summaryFields = document.getElementById('summaryFields');
        const descriptionInput = document.getElementById('descriptionInput');
        const form = document.getElementById('sessionForm');

        formatSelect.addEventListener('change', () => {
            const selected = formatSelect.value;
            soapFields.classList.add('hidden');
            dapFields.classList.add('hidden');
            summaryFields.classList.add('hidden');

            if (selected === 'SOAP') {
                soapFields.classList.remove('hidden');
            } else if (selected === 'DAP') {
                dapFields.classList.remove('hidden');
            } else if (selected === 'Session Summary') {
                summaryFields.classList.remove('hidden');
            }
        });

        form.addEventListener('submit', (e) => {
            const format = formatSelect.value;
            let combined = '';

            if (format === 'SOAP') {
                const s = document.getElementById('subjective').value;
                const o = document.getElementById('objective').value;
                const a = document.getElementById('assessment').value;
                const p = document.getElementById('plan').value;
                combined = `Subjective:\n${s}\n\nObjective:\n${o}\n\nAssessment:\n${a}\n\nPlan:\n${p}`;
            } else if (format === 'DAP') {
                const d = document.getElementById('data').value;
                const a = document.getElementById('dap_assessment').value;
                const p = document.getElementById('dap_plan').value;
                combined = `Data:\n${d}\n\nAssessment:\n${a}\n\nPlan:\n${p}`;
            } else if (format === 'Session Summary') {
                const title = document.getElementById('summaryTitle').value;
                const description = document.getElementById('summaryDescription').value;
                combined = `Title:\n${title}\n\nDescription:\n${description}`;
            }

            descriptionInput.value = combined;
        });
    </script>

</x-app-layout>