<?php

namespace App\Http\Controllers;

use App\Models\clients;
use App\Models\feedback;

class clientController extends Controller
{
    public function index()
    {
        return clients::all();
    }
    public function index_client()
    {
        return clients::all()->where('TypeOfClient', 1);
    }
    public function index_ex_im()
    {
        return clients::all()->where('TypeOfClient', 2);
    }
    public function index_fac()
    {
        return clients::all()->where('TypeOfClient', 3);
    }
    public function feedback()
    {
        return $this->hasMany(feedback::class);
    }
}
