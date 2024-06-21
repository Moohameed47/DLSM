<?php

namespace App\Http\Controllers;

use App\Models\agents;
use App\Models\requests;

class agentController extends Controller
{
    public function index()
    {
        return agents::with('shipping_company')->whereHas('shipping_company')->get();

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
            "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_company",
            "Password" => "required|confirmed",
            "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_company",
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