<?php

namespace App\Http\Controllers;

use App\Models\clients;
use Illuminate\Http\Request;

class clientController extends Controller
{
    public function index()
    {
        $clients = clients::all();
        dd($clients);
    }
}
