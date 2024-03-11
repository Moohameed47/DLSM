<?php

namespace App\Http\Controllers;

use App\Models\admins;
use App\Models\agents;
use App\Models\clients;
use App\Models\shipping_companies;
use Illuminate\Http\Request;

class profileController extends Controller
{

    public function index(Request $req){
        if($req->TypeOfClient == "5"){
            $admin = admins::where('id', $req->id)->first();
            return $admin;
        }        
        else if ($req->TypeOfClient == "4") {
            $shipping_companies = shipping_companies::where('id', $req->id)->first();
            return $shipping_companies;
        }
        else if ($req->TypeOfClient == "3" || $req->TypeOfClient == "2" || $req->TypeOfClient == "1" ) {
            $client = clients::where('id', $req->id)->first();
            return $client;
        }
        else if ($req->TypeOfClient == "6") {
            $agents = agents::where('id', $req->id)->first();
            return $agents;
        }
    }

}
