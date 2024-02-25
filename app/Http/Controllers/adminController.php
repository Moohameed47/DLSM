<?php

namespace App\Http\Controllers;

use App\Models\admins;

class adminController extends Controller
{
    //
    public function index()
    {
        $admins = admins::all();
        return $admins;
    }

}
