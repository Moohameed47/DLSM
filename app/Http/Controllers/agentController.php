<?php

namespace App\Http\Controllers;

use App\Models\agents;

class agentController extends Controller
{
    public function index()
    {
        $agent = agents::all();
        return $agent;
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
            "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
            "Password" => "required|confirmed",
            "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
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
