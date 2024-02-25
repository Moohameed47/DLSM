<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'fac_ex_im_id', 'Country', 'Location', 'Destination', 
        'Comment', 'GoodsType', 'Weight', 'Height', 'Lenght', 'Width', 'Transport',
         'TypesOfTruck', 'WeightOfSingleCarton', 'ContainerTypeAndSize', 'NumberOfContainer',
          'Safety', 'TypeOfRequest', 'TypeOfInternational','client_id','ACCEPT','DONE',
    ];

//    public function factory()
//    {
//        return $this->belongsTo(fac_ex_im_companies::class);
//    }

    public function client()
    {
        return $this->belongsTo(clients::class);
    }
}
