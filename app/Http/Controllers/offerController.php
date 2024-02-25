<?php

namespace App\Http\Controllers;

use App\Models\offers;

class offerController extends Controller
{

    public function index()
    {
        return offers::all();
    }
}
