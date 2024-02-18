<?php

namespace App\Http\Controllers;

use App\Models\shipping_companies;
use Illuminate\Http\Request;

class shipping_companyController extends Controller
{
    public function index()
    {
        return shipping_companies::all();
    }
}
