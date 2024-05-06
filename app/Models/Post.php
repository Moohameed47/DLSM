<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','data','shipping_companies_id'
    ];
    public function shippingCompany()
    {
        return $this->belongsTo(shipping_companies::class, 'shipping_companies_id');
    }
}
