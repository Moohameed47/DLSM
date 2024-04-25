<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offers extends Model
{
    use HasFactory;

    protected $fillable = [
        'agents_id', 'Price', 'PL', 'TT', 'FT', 'OF', 'THC', 'ExtraFees', 'PowerPerDay', 'request_id', 'From', 'To','CustomsPrice','TruckingPrice'
    ];

    public function agent()
    {
        return $this->belongsTo(agents::class);
    }
    public function request()
    {
        return $this->belongsTo(requests::class);
    }

}
