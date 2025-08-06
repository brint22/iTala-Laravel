<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionNote;
use App\Models\Client;

class SessionNoteController extends Controller
{
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'format_type' => 'required|string|in:SOAP,DAP',
            'description' => 'required|string',
        ]);

        $client->sessionNotes()->create([
            'appointment_id' => $request->appointment_id,
            'format_type' => $request->format_type,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Session Note Added!');
    }
}
