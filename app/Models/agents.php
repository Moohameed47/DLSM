<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agents extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_id', 'Name', 'Email', 'Password', 'PhoneNumber'
    ];

    public function shipping_companies()
    {
        return $this->belongsTo(shipping_companies::class, 'shipping_id');
    }
    public function offers()
    {
        return $this->hasMany(offers::class);
    }
}
