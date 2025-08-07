<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\SessionNote;


class Client extends Authenticatable
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
        'password', // Make sure this is fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function sessionNotes(): HasMany
    {
        return $this->hasMany(SessionNote::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
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
