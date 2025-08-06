<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function view(Client $client)
    {
        $appointments = $client->appointments; // make sure relation exists

        return response()->json([
            'client' => $client,
            'appointments' => $appointments,
        ]);
    }
}
