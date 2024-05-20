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
    public function agents()
    {
        return $this->hasMany(agents::class);
    }
    public function posts()
    {
        return $this->hasMany(posts::class);
    }
    public function feedback()
    {
        return $this->hasMany(feedback::class);
    }
}
