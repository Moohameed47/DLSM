<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\admins;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //
    public function index()
    {
        $admins = admins::all();
        return $admins;
    }

}
