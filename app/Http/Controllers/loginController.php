<?php

namespace App\Http\Controllers;

use App\Models\admins;
use App\Models\agents;
use App\Models\clients;
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
        $agent = agents::where('Email', $req->Email)->first();
        if (!empty($admin)){
            if (Hash::check($req->Password, $admin->Password)) {
                $token = $admin->createToken("myToken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "token" => $token,
                    "id" => $admin->id,
                    "TypeOfClient" => 5 // ADMIN
                ]);
            }
            else
             return response()->json([
                "status" => false,
                "message" => "Password Didn't Match",
            ]);
        }
        else if (!empty($client)){
            if (Hash::check($req->Password, $client->Password)) {
                $token = $client->createToken("myToken")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "token" => $token,
                    "id" => $client->id,
                    "TypeOfClient" => $client->TypeOfClient,  // 1 , 2  , 3
                ]);
            } else return response()->json([
                "status" => false,
                "message" => "Password Didn't Match",
            ]);
        }
        else if (!empty($agent)){
            if ($req->Password == $agent->Password) {
                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "id" => $agent->id,
                    "TypeOfClient" => 6, //Agents
                ]);
            } else return response()->json([
                "status" => false,
                "message" => "Password Didn't Match",
            ]);
        }
        else{
            if (!empty($shipping_companies))
                if (Hash::check($req->Password, $shipping_companies->Password)) {
                    $token = $shipping_companies->createToken("myToken")->plainTextToken;
                    return response()->json([
                        "status" => true,
                        "message" => "Login Successful",
                        "token" => $token,
                        "TypeOfClient" => 4, // Shipping,
                        "id" => $shipping_companies->id
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
}