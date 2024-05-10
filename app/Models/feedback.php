<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'rate',
        'shipping_company_id',
        'client_id',
    ];

    public function shippingCompany()
    {
        return $this->belongsTo(shipping_companies::class);
    }

    public function client()
    {
        return $this->belongsTo(clients::class);
    }
}
