<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
public function storeAppointment(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'TypeofAppointment' => 'required|string',
        'Duration' => 'required|string',
        'Date' => 'required|date',
        'Time' => 'required',
    ]);

    // Create appointment (example, adjust based on your model)
    $client = Client::findOrFail($request->client_id);
    $client->appointments()->create([
        'type' => $request->TypeofAppointment,
        'duration' => $request->Duration,
        'date' => $request->Date,
        'time' => $request->Time,
    ]);

    return redirect()->route('clients.index')->with('success', 'Appointment added successfully!');
}
    
    public function addappointment(Client $client)
    {
        return view('clients.addappointment', compact('client'));
    }
}
