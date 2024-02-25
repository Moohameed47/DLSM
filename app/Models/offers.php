<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offers extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'agents_id', 'Price', 'PL', 'TT', 'FT' ,'OF','THC','ExtraFees','PowerPerDay','request_id'
    ];
    
    public function agent()
    {
        return $this->belongsTo(agents::class);
    }
}
