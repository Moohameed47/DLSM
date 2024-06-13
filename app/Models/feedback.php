<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'message', 'rate', 'shipping_company_id', 'client_id', 'feedback_type',
    ];

    public function shipping_companies()
    {
        return $this->belongsTo(shipping_companies::class, 'shipping_company_id');
    }

    public function client()
    {
        return $this->belongsTo(clients::class);
    }
    public function enumFeedbackType()
    {
        return ['client', 'shipping_company'];
    }
}
