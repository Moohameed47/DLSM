<?php

namespace App\Http\Controllers;

use App\Models\agents;
use App\Models\requests;

class agentController extends Controller
{
    public function index()
    {
        return agents::with('shipping_companies')->whereHas('shipping_companies')->get();

        return agents::all();
    }
    public function ShippingAgent($id){
        $agents = agents::where('shipping_id', $id)->get();
        return $agents;
    }
    public function show($id)
    {
        $agent = agents::all()->where('id', $id)->first();
        return $agent == null ? "Not Found" : $agent;
    }

    public function delete($id)
    {
        $agent = agents::where('id', $id)->delete();
        return `$id is Deleted`;
    }

    public function store()
    {
        request()->validate([
            "Name" => "required",
            "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies",
            "Password" => "required|confirmed",
            "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_companies",
            "shipping_id" => "required"
        ]);
        $newAgent = request()->all();
        agents::create($newAgent);
        return response()->json([
            "status" => true,
            "message" => "New Agent has been created",
        ]);
    }
}
