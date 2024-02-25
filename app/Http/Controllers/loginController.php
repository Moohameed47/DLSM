<?php

namespace App\Http\Controllers;

use App\Models\admins;
use App\Models\clients;
use App\Models\fac_ex_im_companies;
use App\Models\shipping_companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            "Email" => "required|email",
            "Password" => "required",
        ]);
        $admin = admins::where('Email', $req->Email)->first();
        $client = clients::where('Email', $req->Email)->first();
        $shipping_companies = shipping_companies::where('Email', $req->Email)->first();
        if (!empty($admin))
            if (Hash::check($req->Password, $admin->Password)) {
                $token = $admin->createToken("myToken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "token" => $token,
                ]);
            } else return response()->json([
                "status" => false,
                "message" => "Password Didn't Match",
            ]);
        else if (!empty($client))
            if (Hash::check($req->Password, $client->Password)) {
                $token = $client->createToken("myToken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "token" => $token,
                ]);
            } else return response()->json([
                "status" => false,
                "message" => "Password Didn't Match",
            ]);
        else
            if (!empty($shipping_companies))
                if (Hash::check($req->Password, $shipping_companies->Password)) {
                    $token = $shipping_companies->createToken("myToken")->plainTextToken;
                    return response()->json([
                        "status" => true,
                        "message" => "Login Successful",
                        "token" => $token,
                    ]);
                } else return response()->json([
                    "status" => false,
                    "message" => "Password Didn't Match",
                ]);
            else return response()->json([
                "status" => false,
                "message" => "Invalid Login Details",
            ]);
    }
}
