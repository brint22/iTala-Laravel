<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'name_extension',
        'birthdate',
        'gender',
        'civil_status',
        'contact_number',
        'email',
        'address',
        'emergency_contact_name',
        'emergency_contact_number',
    ];

    // 🔽 Add this relationship method
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}


