<?php

namespace App\Http\Controllers;

use App\Models\admins;
use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function index()
    {
        $admins = admins::all();
        return $admins;
    }
}
