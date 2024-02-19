<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    use HasFactory;
    protected $fillable = [
        'Country','Location','Destination','Comment','GoodsType','Weight','Height','Lenght','Width','Transport','TypesOfTruck','WeightOfSingleCarton','ContainerTypeAndSize','NumberOfContainer','Safety','TypeOfRequest','TypeOfInternational'
    ];
}
