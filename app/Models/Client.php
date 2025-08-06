<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function sessionNotes()
{
    return $this->hasMany(SessionNote::class);
}

        protected function fullName(): Attribute
    {
        return Attribute::get(function () {
            return $this->last_name . ', ' . $this->first_name . 
                ($this->middle_name ? ' ' . $this->middle_name[0] . '.' : '') .
                ($this->name_extension ? ' ' . $this->name_extension : '');
        });
    }
    
}


