<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ports extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'Name', 'country_id'
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
}
