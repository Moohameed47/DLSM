<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class countryController extends Controller
{
    //
    public function index() {
        dd(Country::all());
        return Country::all();
    }
}