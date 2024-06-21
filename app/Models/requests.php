<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'fac_ex_im_id', 'Country', 'Location', 'Destination', 'Location2', 'Destination2',
        'Comment', 'GoodsType', 'Weight', 'Height', 'Lenght', 'Width', 'Transport',
        'TypesOfTruck', 'WeightOfSingleCarton', 'ContainerTypeAndSize', 'NumberOfContainer',
        'Safety', 'TypeOfRequest', 'TypeOfInternational', 'client_id', 'ACCEPT', 'ACCEPT_ID', 'DONE', 'BestCase',
        'CustomsClearness', 'Tracking', 'TruckingPrice', 'CustomsPrice'
    ];


    public function client()
    {
        return $this->belongsTo(clients::class, 'client_id');
    }
    public function offers()
    {
        return $this->hasMany(offers::class);
    }
}
