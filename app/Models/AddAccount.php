<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddAccount extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'email',
        'Password', // Use capital "P" to match DB column
    ];

    public $timestamps = true;
}
