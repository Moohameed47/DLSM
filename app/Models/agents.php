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

    protected $table = 'agents';

    public function offers()
    {
        return $this->hasMany(offers::class, 'agents_id');
    }

    public function shipping_company()
    {
        return $this->belongsTo(shipping_companies::class, 'shipping_id');
    }
}
