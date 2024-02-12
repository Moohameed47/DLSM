<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admins;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function register(Request $req) {
        $req->validate([
            "Name" => "required",
            "Email" => "required|email|unique:admins",
            "Password" => "required|confirmed",
            "SSN" => "required|unique:admins",
        ]);
        admins::create([
            "Name" => $req->Name,
            "Email" => $req->Email,
            "Password" => Hash::make($req->Password),
            "SSN" => $req->SSN,
        ]);
        return response()->json([
            "status" => true,
            "message" => "Admin Registered Successfully"
        ]);
    }

    
}
