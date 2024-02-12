<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admins;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(Request $req) {
        $req->validate([
            "Email" => "required|email",
            "Password" => "required",
        ]);
        $user = admins::where('Email', $req->Email)->first();
        if(!empty($user))
            if(Hash::check($req->Password, $user->Password)){
                $token = $user->createToken("myToken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "token" => $token,
                ]);
            }
            else return response()->json([
                "status" => false,
                "message" => "Password Didn't Match",
            ]);

        else
        return response()->json([
            "status" => false,
            "message" => "Invalid Login Details",
        ]);
    }}
