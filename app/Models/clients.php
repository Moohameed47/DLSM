<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class clients extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'Name', 'Email', 'Password', 'SSN', 'Photo',
        'Nationality',
        'TaxCard', 'PhoneNumber', 'Address',
        'Website', 'CommercialRecord', 'IndustrialRecord',
        'CountryDealing', 'CountryTarget', 'TypeOfClient'
    ];

    public function request()
    {
        return $this->hasMany(requests::class);
    }
    public function posts()
    {
        return $this->hasManyThrough(
            posts::class,
            shipping_companies::class,
            'shipping_companies_id',
            'id'
        );
    }
    public function second_feedback()
    {
        return $this->hasMany(second_feedback::class);
    }
}
