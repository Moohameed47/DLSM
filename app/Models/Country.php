<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','Name'
    ];
    public function Ports()
    {
        return $this->hasMany(ports::class);
    }
}