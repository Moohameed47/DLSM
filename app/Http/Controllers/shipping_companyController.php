<?php

namespace App\Http\Controllers;

use App\Models\shipping_companies;

class shipping_companyController extends Controller
{
    public function index()
    {
        return shipping_companies::all();
    }
}
