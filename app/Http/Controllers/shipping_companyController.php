<?php

namespace App\Http\Controllers;

use App\Models\shipping_companies;
use App\Models\agents;

class shipping_companyController extends Controller
{
    public function index()
    {
        return shipping_companies::all();
    }

    public function shippingForSpecificAgent($shipping_id){
        return shipping_companies::all()->where('id',$shipping_id);
    }

}
