<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'data', 'shipping_companies_id'
    ];
    public function shipping_companies()
    {
        return $this->belongsTo(shipping_companies::class, 'shipping_company_id');
    }
}
