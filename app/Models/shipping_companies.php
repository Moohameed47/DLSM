<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class shipping_companies extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'Name', 'Email', 'Password', 'Address', 'Website', 'BusinessHistory', 'BusinessHours', 'PhoneNumber'
    ];

    protected $table = 'shipping_companies';

    public function agents()
    {
        return $this->hasMany(agents::class, 'shipping_id');
    }

    public function feedback()
    {
        return $this->hasMany(feedback::class, 'shipping_company_id');
    }

    public function posts()
    {
        return $this->hasMany(posts::class, 'shipping_companies_id');
    }
}
