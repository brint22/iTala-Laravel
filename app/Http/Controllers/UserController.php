<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function viewAccounts()
{
    $users = User::all();
    return view('users.ViewAccounts', compact('users'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'name_extension'  => 'nullable|string|max:10',
            'birthdate'       => 'required|date',
            'gender'          => 'required|string',
            'contact_number'  => 'required|string|max:20',
            'license_number'  => 'nullable|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:6',
            'role'            => 'required|string',
        ]);

        // Combine name fields into 'name'
        $fullName = trim($validated['first_name'] . ' ' . $validated['middle_name'] . ' ' . $validated['last_name'] . ' ' . $validated['name_extension']);

        // Create user
        User::create([
            'first_name'     => $validated['first_name'],
            'middle_name'    => $validated['middle_name'],
            'last_name'      => $validated['last_name'],
            'name_extension' => $validated['name_extension'],
            'birthdate'      => $validated['birthdate'],
            'gender'         => $validated['gender'],
            'contact_number' => $validated['contact_number'],
            'license_number' => $validated['license_number'],
            'name'           => $fullName,
            'email'          => $validated['email'],
            'password'       => Hash::make($validated['password']),
            'role'           => $validated['role'],
        ]);

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }
}

