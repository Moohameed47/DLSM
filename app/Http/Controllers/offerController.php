<?php

namespace App\Http\Controllers;

use App\Models\offers;
use Illuminate\Http\Request;

class offerController extends Controller
{

    public function index()
    {
        return offers::all();
    }}
