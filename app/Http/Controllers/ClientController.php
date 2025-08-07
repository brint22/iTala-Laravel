<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Appointment;
use App\Models\SessionNote; // 👈 Make sure this is included
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Show the add account form with password field
    public function addAccount(Client $client)
    {
        return view('clients.add-account', compact('client'));
    }
    // Show the Add Account (Set Password) form
    public function createAccount($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.addaccount', compact('client'));
    }

    // Store the password securely
    public function storeAccount(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Get the client
        $client = Client::findOrFail($id);

        // Check if a user already exists with this email
        $existingUser = User::where('email', $client->email)->first();

        if ($existingUser) {
            return redirect()->back()->with('error', 'User account already exists for this client.');
        }

        // Create a user account for this client
        $user = User::create([
            'name' => $client->first_name . ' ' . $client->last_name,
            'first_name' => $client->first_name,
            'middle_name' => $client->middle_name,
            'last_name' => $client->last_name,
            'name_extension' => $client->name_extension,
            'birthdate' => $client->birthdate,
            'gender' => $client->gender,
            'contact_number' => $client->contact_number,
            'license_number' => null, // Or handle as needed
            'role' => 'Client',
            'email' => $client->email,
            'password' => Hash::make($request->password),
        ]);


        // Link user to client
        $client->user_id = $user->id;
        $client->password = Hash::make($request->password); // Optional: Store password on Client too if needed
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client account created successfully.');
    }





    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.ViewClients', compact('clients'));
    }
    public function viewSessionNotes($clientId)
    {
        $client = Client::with('sessionNotes.appointment')->findOrFail($clientId);
        return view('clients.ViewSessionNotes', compact('client'));
    }

    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();

        $client = $user->client;

        if (!$client) {
            return redirect()->back()->with('error', 'Client profile not found.');
        }

        $sessionNotes = $client->sessionNotes;


        return view('clients.dashboard', compact('client', 'sessionNotes'));
    }
}
