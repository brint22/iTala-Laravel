<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'client_id',
        'TypeofAppointment',
        'Duration',
        'Date',
        'Time',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
