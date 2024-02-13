<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class clients extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'Name','Email','Password','SSN','Photo','Nationality','PhoneNumber'
    ];
}
