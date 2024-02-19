<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class fac_ex_im_companies extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'Name', 'Email', 'Password', 'TaxCard', 'PhoneNumber', 'Address', 'Website', 'CommercialRecord','IndustrialRecord','CountryDealing','CountryTarget','TypeOfCompany'
    ];
}
