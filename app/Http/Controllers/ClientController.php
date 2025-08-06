<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Appointment;
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

        // Save client
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
    // Optional: show all clients (for future use)


    public function index()
    {
        $clients = Client::paginate(10); // or whatever number per page you want
        return view('clients.ViewClients', compact('clients'));
    }


    

    // Optional: show, edit, update, destroy can be added later
}
