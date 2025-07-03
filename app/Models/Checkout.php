<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'id', 'name', 'email', 'address', 'city', 'zip',
        'cardname', 'cardnumber', 'expmonth', 'expyear', 'cvv'
    ];

}
