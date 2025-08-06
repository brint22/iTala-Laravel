<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Appointment;
use App\Models\SessionNote; // 👈 Make sure this is included
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Show the form to add a new client.
     */
    public function addClient()
    {
        return view('clients.addclient');
    }

    /**
     * Store a newly created client in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'              => 'required|string|max:255',
            'middle_name'             => 'nullable|string|max:255',
            'last_name'               => 'required|string|max:255',
            'name_extension'          => 'nullable|string|max:10',
            'birthdate'               => 'required|date',
            'gender'                  => 'required|string|max:30',
            'civil_status'            => 'required|string|max:20',
            'contact_number'          => 'required|string|max:20',
            'email'                   => 'required|email|unique:clients,email',
            'address'                 => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:20',
        ]);

        Client::create($validated);

        return redirect()->route('clients.addclient')->with('success', 'Client created successfully!');
    }

    public function addappointment(Client $client)
    {
        return view('clients.addappointment', compact('client'));
    }

    public function storeAppointment(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'TypeofAppointment' => 'required|string|max:255',
            'Duration' => 'required|string|max:50',
            'Date' => 'required|date',
            'Time' => 'required',
        ]);

        Appointment::create($validated);

        return redirect()->route('clients.index')->with('success', 'Appointment created successfully!');
    }

    public function addSessionNoteForm(Client $client)
    {
        return view('clients.AddSessionNote', compact('client'));
    }

    public function storeSessionNote(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appointment_id' => 'required|exists:appointments,id',
            'format_type' => 'required',
            'description' => 'required',
        ]);

        SessionNote::create([
            'client_id' => $request->client_id,
            'appointment_id' => $request->appointment_id,
            'format_type' => $request->format_type,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Session note saved successfully.');
    }


    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.ViewClients', compact('clients'));
    }
}
